@extends('layouts.app')
@section('content')
<div class="card card-default">
  <div class="card-header">
    {{isset($tag)?'Edit Tag':'Creat New Tag'}}

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
    <form class="" action="{{isset($tag)? route('tags.update',$tag->id):route('tags.store')}}" method="post">
      @csrf
      
      @if(isset($tag))
      @method('PUT')
      @endif
      <div class="form-group">
        <label for="name">Tag Name</label>
        <input type="text" class="form-control" name="name" value="{{isset($tag)?$tag->name:''}}" placeholder="tag name">
      </div>
      <div class="form-group">
        <button type="submit" class="form-control btn btn-success" name="button">{{isset($tag)?'Update':'Create'}}</button>
      </div>
    </form>
  </div>
</div>
@endsection
