@extends('layouts.app');
@section('content')
<div class="card card-default">
  <div class="card-header">
    Categories
  </div>
@if($categories->count() > 0)
<div class="card-body">
  <ul class="list-group">
    @foreach($categories as $category)
    <li class="list-group-item">{{$category->name}}
      @if(!$category->trashed())
  <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary float-right">Edit</a>
  @endif
  <button  class="btn btn-danger float-right mr-2" onclick="handleDelete({{$category->id}})" name="button">{{$category->trashed()?'Delete':'Trash'}} </button>
<a class="float-right mr-4"name="button">{{$category->posts->count()??''}}</a>

    </li>
    @endforeach
  </ul>
</div>
@else
<h3 class="text-center">No categories here</h3>
@endif
</div>
<br>
<div class="justify-content-center">
  <a href="{{route('categories.create')}}" class="btn btn-success ">Add Category</a>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form  action="" method="post" id="deleteCategoryForm">
    @csrf
    @method('DELETE')
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this category?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go back</button>
        <button type="submit" class="btn btn-primary">Yes,delete.</button>
      </div>
    </div>
  </form>
  </div>
</div>
@endsection
@section('scripts')
<script>
function handleDelete(id){
  var form=document.getElementById('deleteCategoryForm')
  form.action='/categories/'+ id
  $('#deleteModal').modal('show')
}

</script>
@endsection
