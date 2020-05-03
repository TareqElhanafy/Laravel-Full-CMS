@extends('layouts.app')
@section('content')
<div class="card card-default">
  <div class="card-header">
 Welcome {{auth()->user()->name}}
  </div>
    <div class="card-body">
      <table class="table">
        <thead>
<th>Name</th>
<th>About</th>
  </thead>
  <tbody>
    <tr>
      <td>{{auth()->user()->name}}</td>
      <td>{{auth()->user()->about}}</td>
    </tr>
  </tbody>


      </table>
      <a href="{{route('user.edit')}}" class="btn btn-primary">Edit Your Profile</a>

</div>
</div>
@endsection
