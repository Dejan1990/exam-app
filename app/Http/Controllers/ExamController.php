<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;

class ExamController extends Controller
{
    public function create()
    {
        $quizzes = Quiz::all();
        $users = User::isNotAdmin();
    	return view('backend.exam.create', [ 
            'quizzes' => $quizzes,
            'users' => $users 
        ]);
    }
}
