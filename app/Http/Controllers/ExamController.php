<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Result;

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

    public function removeExam(Request $request)
    {
    	$userId = $request->get('user_id');
    	$quizId= $request->get('quiz_id');
    	$quiz = Quiz::find($quizId);
    	$result = Result::where('quiz_id', $quizId)->where('user_id', $userId)->exists();
    	if($result){
    		return back()->with('message', 'This quiz is played by user so it cannot be removed!');
    	}else{
    		$quiz->users()->detach($userId);
    		return redirect()->back()->with('message', 'Exam is now not assigned to that user!');
    	}
    }
}
