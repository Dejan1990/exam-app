@extends('backend.layouts.master')

	@section('title','create user')

	@section('content')

	<div class="span9">
        <div class="content">
           @include('messages._message')
            <div class="module">
                <div class="module-head">
                    <h3>Create User</h3>
                </div>

                <div class="module-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @include('backend.user._form', [ 'buttonText' => 'Create User' ])                           	
                    </form>

                </div>
            </div>

            </div>

        </div>
    </div> 

@endsection 