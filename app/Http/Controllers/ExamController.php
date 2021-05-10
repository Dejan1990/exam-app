<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Result;
use App\Models\Answer;
use App\Models\Question;

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

    public function postQuiz(Request $request)
    {
        return $userQuestionAnswer = Result::updateOrCreate([
            'user_id' => auth()->user()->id,
            'quiz_id' => $request['quizId'], 
            'answer_id' => $request['answerId'],
            'question_id' => $request['questionId']// obratiti paznju na ovo quizId, answerId, questionId -> tako je u QuizComponent.vue postuserChoice()
        ]);
    }

    public function result()
    {
        $quizzes = Quiz::with('users')->get();
        return view('backend.result.index',compact('quizzes'));
    }

    public function userQuizResult($userId, $quizId)
    {
        $results = Result::where('user_id',$userId)->where('quiz_id',$quizId)->get();
        $totalQuestions = Question::where('quiz_id',$quizId)->count();
        $attemptQuestion = Result::where('quiz_id',$quizId)->where('user_id',$userId)->count();
        $quiz = Quiz::where('id',$quizId)->get();

        $ans=[];
        foreach($results as $answer){
            array_push($ans,$answer->answer_id);
        }
        $userCorrectedAnswer = Answer::whereIn('id',$ans)->where('is_correct',1)->count();
        $userWrongAnswer = $totalQuestions-$userCorrectedAnswer;
        if($attemptQuestion){
            $percentage = ($userCorrectedAnswer/$totalQuestions)*100;
        }else{
            $percentage=0;
        }


        return view('backend.result.result',compact('results','totalQuestions','attemptQuestion','userCorrectedAnswer','userWrongAnswer','percentage','quiz'));
    }
}
