@extends('backend.layouts.master')

@section('title','create quiz')

@section('content')

<div class="span9">
    <div class="content">
        @include('messages._message')
        <div class="module">
            <div class="module-head">
                <h3>All Users</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Occupation</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      @if($users->count() > 0)
                      @foreach($users as $key => $user)
                    <tr>
                      <td>{{ $key + $users->firstItem() }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->occupation }}</td>
                      <td>{{ $user->address }}</td>
                      <td>{{ $user->phone }}</td>
                      <td>
                        <a href="{{ route('user.edit', $user) }}">
                            <button class="btn btn-primary">Edit</button>
                        </a>
                      </td>
                      <td>
                          <form id="delete-form{{$user->id}}" method="POST" action="{{route('user.destroy',[$user->id])}}" >
                            @csrf
                            @method('DELETE')
                          </form>
                          <a href="#" onclick="if(confirm('Do you want to delete?')){
                              event.preventDefault();
                              document.getElementById('delete-form{{$user->id}}').submit()
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
                    <td>No user to display</td>
                    @endif
                  </tbody>
                </table>
                <div class="pagination pagination-centered" >
                    {{$users->links()}}
                </div>
               </div>
           </div>
        </div>
       </div>
    </div>
@endsection