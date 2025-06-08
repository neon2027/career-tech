<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QuizResult;
use App\Models\PersonalityType;

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
        $this->personalityTypeId = 1;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
        ]);

        // Save the quiz results
        $result = QuizResult::create([
            'name' => $this->name,
            'email' => $this->email,
            'answers' => json_encode($this->answers),
            'personality_type_id' => $this->personalityTypeId,
        ]);

        // Clear the quiz answers from session since quiz is complete
        session()->forget('quiz_answers');

        // Redirect to results page
        return redirect()->route('quiz.results', ['id' => $result->id]);
    }

    public function render()
    {
        return view('livewire.quiz-submission');
    }
}
