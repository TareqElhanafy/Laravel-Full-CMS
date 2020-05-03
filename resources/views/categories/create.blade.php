@extends('layouts.app');
@section('content')
<div class="card card-default">
  <div class="card-header">
    Add Categories
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
    <form class="" action="{{route('categories.store')}}" method="post">
      @csrf
      <div class="form-group">
        <label for="title">Category Name</label>
        <input type="text" name="name" class="form-control"  placeholder="Name">
      </div>
      <div class="form-group">
        <button type="submit" class="form-control btn btn-primary" name="submit">Add</button>

      </div>
    </form>

  </div>
</div>



@endsection
