@extends('layouts.app')
@section('content')
<div class="card card-default">
  <div class="card-header">
    Tags
  </div>
  @if($tags->count()>0)
  <div class="card-body">
    <table class="table">
      <thead>
      <th>Id</th>
      <th>Name</th>
      <th>Posts related</th>
    </thead>
    <tbody>
      @foreach($tags as $tag)
      <tr>
        <td>{{$tag->id}}</td>
        <td>{{$tag->name}}</td>
        <td>{{$tag->posts->title}}</td>
        @if(!$tag->trashed())
        <td><a class="btn btn-primary" href="{{route('tags.edit',$tag->id)}}">Edit</a></td>
        @endif
        <form class="" action="{{route('tags.destroy',$tag->id)}}" method="post">
@csrf
@method('DELETE')
<td><button class="btn btn-danger" href="{{route('tags.destroy',$tag->id)}}">{{$tag->trashed()?'Delete':'Trash'}}</button></td>

        </form>
        @if($tag->trashed())
        <form class="" action="{{route('restored.tags',$tag->id)}}" method="post">
@csrf
@method('PUT')
<td>
<button type="submit"  class="btn btn-success mr-2"name="button">Restore</button>
</td>
        </form>
        @endif
      </tr>
      @endforeach
    </tbody>

    </table>
  </div>
  @else

  <h1 class="text-center"> No Tags yet !</h1>


  @endif
  <div class="card-footer">
    <a href="{{route('tags.create')}}" class="btn btn-primary">Creat new Tag</a>
  </div>
</div>
@endsection
