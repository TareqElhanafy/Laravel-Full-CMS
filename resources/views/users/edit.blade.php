@extends('layouts.app');
@section('content')
<div class="card card-default">
  <div class="card-header">
    Edit Profile
  </div>
  <div class="card-body">
    @if($errors->any())
    <div class="alert alert-danger">
      <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item">{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form class="" action="{{route('user.update')}}" method="post">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="name" class="form-control"  placeholder="Name" value="{{$user->name}}">
      </div>
      <div class="form-group">
        <label for="title">About</label>
        <input type="text" name="about" class="form-control"  placeholder="about" value="{{$user->about}}">
      </div>
      <div class="form-group">
        <button  class="form-control btn btn-primary" >Update</button>

      </div>
    </form>

  </div>
</div>



@endsection
