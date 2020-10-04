@extends('task')
@section('body')
<div class="container py-5">
    <div class="row py-5">
    <div class="card mx-auto">
        <h4 class="card-header bg-info text-white text-center">Edit Task</h4>
        <div class="card-body">
            <!-- Default form contact -->
            @include('inc.messages')
<form class="form" action="{{ route('task.update', $tasks->id )}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ csrf_field() }}
    {{ method_field('PUT')}}

    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title name" value="{{ $tasks->title }}">
    </div>
    <div class="form-group">
        <label>Upload Image</label><br>
                    <input type="file" name="image" id="image" value="{{ $tasks->image }}">
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea2">Message </label>
     <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="content">
        {{$tasks->content}}
        </textarea>
    </div>
    <div class="d-flex justify-content-center align-center">
    <button type="submit" class="btn btn-info ">Update</button>
<div>
</form>
<!-- Default form contact -->
      </div>
    </div>
</div>
@endsection
