<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QuizResult;
use App\Models\PersonalityType;
use App\Models\PersonalityQuestion;

class QuizResults extends Component
{
    public $result;
    public $personalityTypes;
    public $isTie = false;

    public function mount($id)
    {
        $this->result = QuizResult::findOrFail($id);
        $this->calculatePersonalityTypes();
    }

    private function calculatePersonalityTypes()
    {
        $answers = json_decode($this->result->answers, true);
        $points = [];

        foreach ($answers as $questionId => $answer) {
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
            $this->isTie = true;
            $highestTypeIds = array_slice($highestTypeIds, 0, 2);
        }

        $this->personalityTypes = PersonalityType::whereIn('id', $highestTypeIds)->get();
    }

    public function render()
    {
        return view('livewire.quiz-results')->layout('livewire.layouts.app');
    }
}
