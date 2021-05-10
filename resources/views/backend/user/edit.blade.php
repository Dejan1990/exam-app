@extends('backend.layouts.master')

@section('title','Update user')

@section('content')
    <div class="span9">
        <div class="content">
            @include('messages._message')
            <div class="module">
                <div class="module-head">
                    <h3>Update User</h3>
                </div>
                <div class="module-body">
                    <form action="{{ route('user.update', $user) }}" method="POST">
                        @method('PUT')
                    @include('backend.user._form', [ 'buttonText' => 'Update User' ])                              	
                    </form>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection