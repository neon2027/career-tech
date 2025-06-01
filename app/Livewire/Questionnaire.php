<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalityQuestion;
use App\Models\PersonalityType;

class Questionnaire extends Component
{
    public $answers = [];
    public $highestTypes = [];

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
        ]);
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
                $points[$typeId] += $answer; // Assuming answer is a numeric value
            }
        }

        // Find the max score
        $maxScore = max($points);

        // Get all personality types that have this max score (handle tie)
        $highestTypeIds = array_keys(array_filter($points, fn($score) => $score === $maxScore));
        $this->highestTypes = PersonalityType::whereIn('id', $highestTypeIds)->get();

    }

    public function getAnsweredCountProperty()
    {
        // Count how many questions have answers (non-empty)
        return count(array_filter($this->answers, fn($answer) => !is_null($answer) && $answer !== ''));
    }

    public function updatedAnswers()
    {
        $this->dispatch('update-progress', [
            'answered' => $this->answeredCount,
            'total' => PersonalityQuestion::count(), // or use the interleaved count
        ]);
    }

}
