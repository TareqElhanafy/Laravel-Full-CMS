@extends('layouts.app')

@section('content')
<div class="card card-default">
  <div class="card-header">
    Creat New Post
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
    <form class="" action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="post" enctype="multipart/form-data">

      @csrf
@if(isset($post))
@method('PUT')
@endif
      <div class="form-group">
    <label for="title">Title</label>
   <input type="text" name="title" class="form-control" value="{{isset($post)?$post->title:''}}" placeholder="post title">
      </div>
      <div class="form-group">
    <label for="tags">Description Tags</label>
   <input type="text" name="description" class="form-control" value="{{isset($post)?$post->description:''}}" placeholder="post tags">
      </div>
      <div class="form-group">
    <label for="content">Content</label>
<textarea name="content" rows="8" class="form-control" placeholder="post content" cols="80">{{isset($post)?$post->content:''}}</textarea>
  </div>
  @if(isset($post))
  <div class="form-group">
<label for="image">Image</label>
<img src="{{$post->image}}" alt="">
  </div>
  @else
  <div class="form-group">
<label for="image">Image</label>
<input type="file" name="image" class="form-control"  >
  </div>
  @endif
  <div class="form-group">
<label for="date">Published At</label>
<input type="text" name="published_at"class="form-control" value="{{isset($post) ? $post->published_at :''}}" id="published_at" placeholder="post date">
</div>
<div class="form-group">
<label for="category">category</label>
<select class="form-control" name="category_id">
  @foreach($categories as $category)
  <option value="{{$category->id}}">
    {{$category->name}}
  </option>
  @endforeach
</select>
</div>
@if($tags->count()>0)
<div class="form-group">
  <label for="tags">Tags</label>
  <select class="form-control tags-selector " name="tags[]" multiple>
    @foreach($tags as $tag)
    <option value="{{$tag->id}}">{{$tag->name}}</option>
    @endforeach
  </select>
</div>
@endif
  <div class="form-group">
<button type="submit" class="btn btn-success" name="button"> {{isset($post)? 'Update':'Publish'}}</button>
  </div>
    </form>
  </div>
</div>



@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
  flatpickr('#published_at');
  $(document).ready(function() {
      $('.tags-selector').select2();
  });
</script>

@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
