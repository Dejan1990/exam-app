@extends('backend.layouts.master')

	@section('title','create quiz')

	@section('content')

	<div class="span9">
        <div class="content">
            @include('messages._message')
            <div class="module">
                <div class="module-head">
                    <h3>All Quiz</h3>
                </div>

                <div class="module-body">
                    <table class="table table-striped">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Description</th>
							<th>Minutes</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@if($quizzes->count() > 0)
						@foreach($quizzes as $quiz)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ $quiz->name }}</td>
							<td>{{ $quiz->description }}</td>
							<td>{{ $quiz->minutes }}</td>
							<td>
							<a href="#">
								<button class="btn btn-inverse">View Questions</button>
							</a>
							</td>

							<td>
								<a href="{{ route('quiz.edit', $quiz) }}">
									<button class="btn btn-primary">Edit</button>

								</a>
							</td>

							<td>
								<form class="form-delete" method="POST" action="{{ route('quiz.destroy', $quiz) }}">
									@method('DELETE')
									@csrf
									<button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
								</form>
							</td>

						</tr>
						@endforeach

						@else
						<td>No quiz to display</td>
						@endif
						</tbody>
					</table>
                </div>
            </div>

            </div>

        </div>
    </div> 
@endsection 