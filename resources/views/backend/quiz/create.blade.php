@extends('backend.layouts.master')

	@section('title','create quiz')

	@section('content')

	<div class="span9">
     <div class="content">

        @include('messages._message')

    <form action="{{ route('quiz.store') }}" method="POST">
    @include('backend.quiz._form', [ 'buttonText' => 'Create Quiz' ])
</form>
</div>
</div>
@endsection