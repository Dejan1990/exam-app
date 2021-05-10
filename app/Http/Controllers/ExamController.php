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

    public function assignExam(Request $request)
    {
       /* $quizId = $request['quiz_id'];
        $quiz = Quiz::find($quizId);
        $userId = $request['user_id'];
    	$quiz->users()->syncWithoutDetaching($userId);*/

        $this->validate($request, [
            'quiz_id' => 'required',
            'user_id' => 'required'
        ]);

        $quiz = Quiz::find($request->quiz_id);
        $quiz->users()->syncWithoutDetaching($request->user_id);
    	return back()->with('message', 'Exam assigned to user successfully!');
    }

    public function userExam(Request $request)
    {
        $quizzes = Quiz::with('users')->get();
    	return view('backend.exam.index', [ 'quizzes' => $quizzes ]);
    }
}
