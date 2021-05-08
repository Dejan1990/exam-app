@extends('backend.layouts.master')

	@section('title','create quiz')

	@section('content')

	<div class="span9">
     <div class="content">
        @include('messages._message')

     <form action="{{ route('quiz.update', $quiz) }}" method="POST">
     	@method('PUT')
         @include('backend.quiz._form', [ 'buttonText' => 'Update Quiz' ])
</form>
</div>
</div>
@endsection