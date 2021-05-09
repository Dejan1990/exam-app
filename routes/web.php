<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;

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
Route::get('quiz/{quiz:slug}', [QuizController::class, 'edit'])->name('quiz.edit');
Route::put('quiz/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
Route::delete('quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');

Route::resource('question', QuestionController::class)->except(['show']);
Route::get('question/{question:slug}', [QuestionController::class, 'show'])->name('question.show');

