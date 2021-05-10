<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('quiz', [QuizController::class, 'store'])->name('quiz.store');
Route::get('quiz/{quiz:slug}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
Route::put('quiz/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
Route::delete('quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');

Route::get('/quiz/{quiz:slug}/questions', [QuizController::class, 'question'])->name('quiz.question');

/*
Route::get('question', [QuestionController::class, 'index'])->name('question.index');
Route::get('question/create', [QuestionController::class, 'create'])->name('question.create');
Route::get('question/{question:slug}', [QuestionController::class, 'show'])->name('question.show');
Route::post('question', [QuestionController::class, 'store'])->name('question.store');
Route::get('question/{question:slug}/edit', [QuestionController::class, 'edit'])->name('question.edit');
Route::put('question/{question}', [QuestionController::class, 'update'])->name('question.update');
Route::delete('question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');*/

Route::resource('question', QuestionController::class)->except(['show', 'edit']);
Route::get('question/{question:slug}', [QuestionController::class, 'show'])->name('question.show');
Route::get('question/{question:slug}/edit', [QuestionController::class, 'edit'])->name('question.edit');

Route::resource('user', UserController::class);
