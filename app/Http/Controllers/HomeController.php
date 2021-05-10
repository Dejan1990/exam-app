<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\Question;
use App\Models\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin === 1) {
            return redirect('/');
        }
        
        $authUser = auth()->user()->id;
        $assignedQuizId = [];
        $user = DB::table('quiz_user')->where('user_id', $authUser)->get();
        foreach($user as $u){
            array_push($assignedQuizId, $u->quiz_id);
        }
        $quizzes = Quiz::with('questions')->whereIn('id', $assignedQuizId)->get();

        $isExamAssigned = DB::table('quiz_user')->where('user_id', $authUser)->exists();
        $wasQuizCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', $this->hasQuizAttempted())->pluck('quiz_id')->toArray();

        return view('home', [
            'quizzes' => $quizzes,
            'isExamAssigned' => $isExamAssigned,
            'wasQuizCompleted' => $wasQuizCompleted
        ]);
    }

    public function getQuizQuestions(Request $request, Quiz $quiz)
    {
        $authUser = auth()->user()->id;
        $quizId = $quiz->id;
        //check if user has been assigned a particular quiz
        $userId = DB::table('quiz_user')->where('user_id', $authUser)->pluck('quiz_id')->toArray();
        if(!in_array($quizId, $userId)){
            return redirect()->to('/home')->with('error', 'You are not assigned this exam');
        }

        $quiz = Quiz::find($quizId);
        $time = Quiz::where('id', $quizId)->value('minutes'); // obratiti paznju
        $quizQuestions = Question::where('quiz_id', $quizId)->with('answers')->get();
        $authUserHasPlayedQuiz = Result::where(['user_id' => $authUser, 'quiz_id' => $quizId])->get();

        //has user played particular quiz
        $wasCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', $this->hasQuizAttempted())->pluck('quiz_id')->toArray();

        if(in_array($quizId, $wasCompleted)){
            return redirect()->to('/home')->with('error', 'You already participated in this exam');
        }

        return view('quiz', [
            'quiz' => $quiz,
            'time' => $time,
            'quizQuestions' => $quizQuestions,
            'authUserHasPlayedQuiz' => $authUserHasPlayedQuiz
        ]);
    }

    private function hasQuizAttempted()
    {
        $attemptQuiz = [];
        $authUser = auth()->user()->id;
        $user = Result::where('user_id', $authUser)->get();
        foreach($user as $u){
            array_push($attemptQuiz, $u->quiz_id);
        }
        return $attemptQuiz;
    }

    public function viewResult($userId, Quiz $quiz)
    {
        $results = Result::where('user_id', $userId)->where('quiz_id', $quiz->id)->with(['question', 'answer'])->get();
        
        return view('result-detail', [ 
            'results' => $results,
        ]);
    }
}
