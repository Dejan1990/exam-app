<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::resource('quiz', QuizController::class)->except(['edit']);
    Route::get('quiz/{quiz:slug}/edit', [QuizController::class, 'edit'])->name('quiz.edit');

    Route::get('/quiz/{quiz:slug}/questions', [QuizController::class, 'question'])->name('quiz.question');

    Route::resource('question', QuestionController::class)->except(['show', 'edit']);
    Route::get('question/{question:slug}', [QuestionController::class, 'show'])->name('question.show');
    Route::get('question/{question:slug}/edit', [QuestionController::class, 'edit'])->name('question.edit');

    Route::resource('user', UserController::class)->except(['edit']);
    Route::get('user/{user:slug}/edit', [UserController::class, 'edit'])->name('user.edit');
});
