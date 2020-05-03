@extends('layouts.app')
@section('content')
<div class="card card-default">
  <div class="card-header">
Users
  </div>
    <div class="card-body">
      @if($users->count()>0)
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>email</th>
            <th>role</th>
          </tr>

        </thead>
        <tbody>
    @foreach($users as $user)
          <tr>
         <td>{{$user->id}}</td>
         <td>{{$user->name}}</td>
         <td>{{$user->email}}</td>
         <td>{{$user->role}}</td>
         @if(!$user->isAdmin())
         <td>
<form class="" action="{{route('users.update',$user->id)}}" method="post">
  @csrf
  @method('PUT')
  <button type="submit" name="button" class="btn btn-success">Make Admin</button>

</form>
         </td>
         @endif
          </tr>
          @endforeach
        </tbody>
      </table>

      @else
      <h3 class="text-center">No posts here</h3>
      @endif
    </div>
  </div>

  </div>
</div>
@endsection
