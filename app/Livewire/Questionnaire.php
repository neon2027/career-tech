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

    protected $listeners = ['question-answered'];

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
        $this->highestTypes = PersonalityType::whereIn('id', $highestTypeIds)->get();

        // Show the submission modal
        $this->showSubmissionModal = true;
    }

    public function getAnsweredCountProperty()
    {
        return count(array_filter($this->answers, fn($answer) => !is_null($answer) && $answer !== ''));
    }

    public function updatedAnswers()
    {
        $this->dispatch('update-progress', [
            'answered' => $this->answeredCount,
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
