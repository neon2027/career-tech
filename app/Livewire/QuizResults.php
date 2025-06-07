<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QuizResult;

class QuizResults extends Component
{
    public $result;

    public function mount($id)
    {
        $this->result = QuizResult::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.quiz-results')->layout('livewire.layouts.app');
    }
}
