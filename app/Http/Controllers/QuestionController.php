<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = (new Question)->getQuestions();
        return view('backend.question.index', [ 'questions' => $questions ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::all();
        return view('backend.question.create', [ 'quizzes' => $quizzes ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'quiz_id'=>'required',
            'question'=>'required',
            'options'=>'required|array|min:3',
            'options.*'=>'required|string|distinct',
            'correct_answer'=>'required'
        ]);

        $answer = new Answer();
        
        $data = $request->all();
        $question = Question::create($data);
        $answer->storeAnswer($data, $question);
        return redirect()->route('question.show', $question)->with('message', 'Question created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('backend.question.show', [ 'question' => $question ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $quizzes = Quiz::all();
        return view('backend.question.edit', [ 
            'question' => $question,
            'quizzes' =>  $quizzes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request,[
            'quiz_id'=>'required',
            'question'=>'required',
            'options'=>'required|array|min:3',
            'options.*'=>'required|string|distinct',
            'correct_answer'=>'required'
        ]);

        $answer = new Answer();
        $data = $request->all();
        $question->update($data);
        $answer->updateAnswer($data, $question);
        return redirect()->route('question.show', $question)->with('message', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        (new Answer)->deleteAnswer($question);
        $question->delete();
        return redirect()->route('question.index')->with('message','Question deleted successfully!');
    }
}
