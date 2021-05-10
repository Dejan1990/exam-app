<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;

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

    Route::get('/exam/create', [ExamController::class, 'create'])->name('exam.create');
    Route::post('/exam/assign', [ExamController::class, 'assignExam'])->name('exam.assign');
    Route::get('exam/user', [ExamController::class, 'userExam'])->name('view.exam');
    Route::post('exam/remove', [ExamController::class, 'removeExam'])->name('exam.remove');
});
