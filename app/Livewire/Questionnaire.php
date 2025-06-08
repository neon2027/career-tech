<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalityQuestion;
use App\Models\PersonalityType;
use App\Models\QuizResult;

class Questionnaire extends Component
{
    public $answers = [];
    public $highestTypes = [];
    public $showSubmissionModal = false;
    public $currentQuestionIndex = 0;

    protected $listeners = ['question-answered', 'modal-closed'];

    public function mount()
    {
        // Load answers from session if they exist
        $this->answers = session('quiz_answers', []);
    }

    public function questionAnswered($index)
    {
        $this->currentQuestionIndex = $index;
    }

    public function render()
    {
        $groupedQuestions = PersonalityQuestion::with('personalityType')
            ->get()
            ->groupBy('personality_type_id');

        // Interleave the questions: 1 from each type, round-robin
        $interleaved = collect();
        $maxCount = $groupedQuestions->map->count()->max();

        for ($i = 0; $i < $maxCount; $i++) {
            foreach ($groupedQuestions as $typeId => $questions) {
                if (isset($questions[$i])) {
                    $interleaved->push($questions[$i]);
                }
            }
        }

        return view('livewire.questionnaire', [
            'personalityQuestions' => $interleaved,
        ])->layout('livewire.layouts.app');
    }

    public function submitAnswers()
    {
        // Check if all questions are answered
        $totalQuestions = PersonalityQuestion::count();
        if ($this->answeredCount < $totalQuestions) {
            $this->addError('answers', 'Please answer all questions before submitting.');
            return;
        }

        $types = PersonalityType::pluck('name', 'id')->toArray();
        $points = [];

        foreach ($this->answers as $questionId => $answer) {
            $question = PersonalityQuestion::find($questionId);
            if ($question) {
                $typeId = $question->personality_type_id;
                if (!isset($points[$typeId])) {
                    $points[$typeId] = 0;
                }
                $points[$typeId] += $answer;
            }
        }

        // Find the max score
        $maxScore = max($points);

        // Get all personality types that have this max score (handle tie)
        $highestTypeIds = array_keys(array_filter($points, fn($score) => $score === $maxScore));

        // If there's a tie, limit to only the first two results
        if (count($highestTypeIds) > 1) {
            $highestTypeIds = array_slice($highestTypeIds, 0, 2);
        }

        $this->highestTypes = PersonalityType::whereIn('id', $highestTypeIds)->get();

        // Show the submission modal and disable body scroll
        $this->showSubmissionModal = true;
        $this->dispatch('modal-opened');
    }

    public function closeModal()
    {
        $this->showSubmissionModal = false;
        $this->dispatch('modal-closed');
    }

    public function modalClosed()
    {
        $this->showSubmissionModal = false;
    }

    public function fillRandomAnswers()
    {
        // Get all questions
        $questions = PersonalityQuestion::all();

        // Fill each question with a random answer (1-5)
        foreach ($questions as $question) {
            $this->answers[$question->id] = rand(1, 5);
        }

        // Save to session
        session(['quiz_answers' => $this->answers]);

        // Update progress
        $this->dispatch('update-progress', [
            'answered' => $this->answeredCount,
            'total' => PersonalityQuestion::count(),
        ]);

        // Show success message
        session()->flash('message', 'All questions have been randomly answered for testing!');
    }

    public function fillTieAnswers()
    {
        // Get all questions grouped by personality type
        $groupedQuestions = PersonalityQuestion::with('personalityType')
            ->get()
            ->groupBy('personality_type_id');

        // Get the first two personality types for creating a tie
        $personalityTypeIds = $groupedQuestions->keys()->take(2);

        // Fill questions to create a tie between first two personality types
        foreach ($groupedQuestions as $typeId => $questions) {
            $score = in_array($typeId, $personalityTypeIds->toArray()) ? 5 : 1; // High score for first two, low for others

            foreach ($questions as $question) {
                $this->answers[$question->id] = $score;
            }
        }

        // Save to session
        session(['quiz_answers' => $this->answers]);

        // Update progress
        $this->dispatch('update-progress', [
            'answered' => $this->answeredCount,
            'total' => PersonalityQuestion::count(),
        ]);

        // Show success message
        $firstType = PersonalityType::find($personalityTypeIds[0]);
        $secondType = PersonalityType::find($personalityTypeIds[1]);
        session()->flash('message', "Created a tie between {$firstType->name} and {$secondType->name} for testing!");
    }

    public function getAnsweredCountProperty()
    {
        return count(array_filter($this->answers, fn($answer) => !is_null($answer) && $answer !== ''));
    }

    public function updatedAnswers()
    {
        // Save answers to session whenever they're updated
        session(['quiz_answers' => $this->answers]);

        $this->dispatch('update-progress', [
            'answered' => $this->answeredCount,
            'total' => PersonalityQuestion::count(),
        ]);
    }

    public function clearSession()
    {
        session()->forget('quiz_answers');
        $this->answers = [];
        $this->highestTypes = [];
        $this->showSubmissionModal = false;

        $this->dispatch('update-progress', [
            'answered' => 0,
            'total' => PersonalityQuestion::count(),
        ]);
    }

    public function getTopThreePercentageProperty()
    {
        $totalAnswers = count($this->answers);
        if ($totalAnswers === 0) {
            return 0;
        }
        $topThreeCount = min(3, $this->answeredCount);
        return ($topThreeCount / $totalAnswers) * 100;
    }
}
