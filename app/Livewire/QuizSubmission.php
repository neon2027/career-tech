<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QuizResult;
use App\Models\PersonalityType;
use App\Models\PersonalityQuestion;
use App\Models\QuizPersonalityScore;

class QuizSubmission extends Component
{
    public $showModal = true;
    public $name = '';
    public $email = '';
    public $answers = [];
    public $highestTypes = [];
    public $personalityTypeId = '';

    public function mount($answers, $highestTypes)
    {
        $this->answers = $answers;
        $this->highestTypes = $highestTypes;
        $this->personalityTypeId = $highestTypes->first()->id;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
        ]);

        // Calculate scores for all personality types
        $allScores = $this->calculateAllPersonalityScores();

        // Save the quiz results
        $result = QuizResult::create([
            'name' => $this->name,
            'email' => $this->email,
            'answers' => json_encode($this->answers),
            'personality_type_id' => $this->personalityTypeId,
        ]);

        // Save individual personality scores
        foreach ($allScores as $typeId => $scoreData) {
            QuizPersonalityScore::create([
                'quiz_result_id' => $result->id,
                'personality_type_id' => $typeId,
                'total_score' => $scoreData['total_score'],
                'max_possible_score' => $scoreData['max_possible_score'],
                'percentage' => $scoreData['percentage'],
            ]);
        }

        // Clear the quiz answers from session since quiz is complete
        session()->forget('quiz_answers');

        // Redirect to results page
        return redirect()->route('quiz.results', ['id' => $result->id]);
    }

    private function calculateAllPersonalityScores()
    {
        $scores = [];

        // Get all personality types
        $personalityTypes = PersonalityType::with('personalityQuestions')->get();

        foreach ($personalityTypes as $type) {
            $totalScore = 0;
            $maxPossibleScore = $type->personalityQuestions->count() * 5; // 5 is max answer value

            // Calculate total score for this personality type
            foreach ($type->personalityQuestions as $question) {
                if (isset($this->answers[$question->id])) {
                    $totalScore += $this->answers[$question->id];
                }
            }

            // Calculate percentage
            $percentage = $maxPossibleScore > 0 ? ($totalScore / $maxPossibleScore) * 100 : 0;

            $scores[$type->id] = [
                'total_score' => $totalScore,
                'max_possible_score' => $maxPossibleScore,
                'percentage' => round($percentage, 2),
            ];
        }

        return $scores;
    }

    public function render()
    {
        return view('livewire.quiz-submission');
    }
}
