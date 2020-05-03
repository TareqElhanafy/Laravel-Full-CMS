@extends('layouts.app')
@section('content')
<div class="card card-card-default">
<div class="card-header">
  Posts
</div>
<div class="card-body">
  @if($posts->count() > 0)
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Tags</th>
        <th>Category</th>
        <th>Content</th>
        <th>Image</th>
        <th>Published At</th>
      </tr>

    </thead>
    <tbody>
@foreach($posts as $post)
      <tr>
     <td>{{$post->id}}</td>
     <td>{{$post->title}}</td>
     <td>{{$post->description}}</td>
     <td>{{$post->tags->count()??''}}</td>
     <td>{{$post->category->name??''}}</td>
     <td>{{$post->content}}</td>
     <td>
       <img src="{{asset('$post->image')}}" alt="">
       </td>
     <td>{{$post->published_at}}</td>
@if(!$post->trashed())
        <td><a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a></td>
        @else
        <form class="" action="{{route('restored.posts',$post->id)}}" method="post">
          @csrf
          @method('PUT')
          <td><button type="submit" class="btn btn-info btn-sm">Restore</button></td>

        </form>
@endif
        <td>
<form class="" action="{{route('posts.destroy',$post->id)}}" method="post">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-sm" type="submit">

{{$post->trashed()?'Delete':'Trash'}}


  </button>
</form>
         </td>
         </tr>
@endforeach

    </tbody>
  </table>

  @else
  <h3 class="text-center">No posts here</h3>
  @endif
</div>

<div class="card-footer">
  <a href="{{route('posts.create')}}" class="btn btn-primary">Create new post</a>
</div>
</div>

@endsection
