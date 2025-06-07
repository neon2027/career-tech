<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Questionnaire;
use App\Livewire\QuizResults;

Route::get('/', function () {
    return redirect()->route('questionnaire');
});
Route::get('/take-quiz', Questionnaire::class)->name('questionnaire');
Route::get('/quiz/results/{id}', QuizResults::class)->name('quiz.results');
