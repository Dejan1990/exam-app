@extends('backend.layouts.master')

	@section('title','create quiz')

	@section('content')

	<div class="span9">
        <div class="content">
            @include('messages._message')
            <div class="module">
                <div class="module-head">
                    <h3>All Questions</h3>
                </div>

                <div class="module-body">
                    <table class="table table-striped">
						<thead>
						<tr>
							<th>#</th>
							<th>Question</th>
							<th>Quiz</th>
							<th>Created</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@if($questions->count() > 0)
						@foreach($questions as $key => $question)
						<tr>
							<td>{{ $key + $questions->firstItem() }}</td>
							<td>{{ $question->question }}</td>
							<td>{{ $question->quiz->name }}</td>
							<td>{{ date('F d,Y',strtotime($question->created_at)) }}</td>
							<td>
							<a href="{{ route('question.show', $question) }}"> <button class="btn btn-info">View</button></a>
							</td>

							<td>
								<a href="{{ route('question.edit', $question) }}">
									<button class="btn btn-primary">Edit</button>

								</a>

							</td>
							<td>
								<form id="delete-form{{$question->id}}" method="POST" action="{{ route('question.destroy', $question) }}">
									@csrf
									@method('DELETE')
								</form>
								<a href="#" onclick="if(confirm('Do you want to delete?')){
									event.preventDefault();
									document.getElementById('delete-form{{$question->id}}').submit()
								}else{
									event.preventDefault();
								}
								">
								<input type="submit" value="Delete" class="btn btn-danger">
							</a>
							</td>
						</tr>
						@endforeach

						@else
						<td>No question to display</td>
						@endif


						</tbody>
					</table>
					<div class="pagination pagination-centered" >
						{{$questions->links()}}
					</div>
                </div>
            </div>

            </div>

        </div>
    </div> 
@endsection 