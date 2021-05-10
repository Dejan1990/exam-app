@extends('backend.layouts.master')

@section('title','create quiz')

@section('content')
	<div class="span9">
     <div class="content">
        @include('messages._message')
        <form action="{{ route('exam.assign') }}" method="POST">
           @csrf
            <div class="module">
                <h3>Assign quiz</h3>
            </div>
            <div class="module-body">
                <div class="control-group">
                    <label class="control-lable" for="name">Choose Quiz</label>
                    <div class="controls"> 
                        <select name="quiz_id" class="span8">
                            <option value="">Choose quiz</option>
                            @foreach($quizzes as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('quiz_id')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $message }}</strong>
                        </span>
                    @enderror      
                </div>
                <div class="control-group">
                    <label class="control-lable" for="name">Choose Quiz</label>
                    <div class="controls"> 
                        <select name="user_id" class="span8 ">
                            <option value="">Choose user</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $message }}</strong>
                        </span>
                    @enderror      
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
          </div>
        </div>
       </form>
     </div>
    </div>
@endsection 