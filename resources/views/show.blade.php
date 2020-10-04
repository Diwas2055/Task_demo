@extends('task')
@section('body')
<div class="container py-5">
    <div class="row py-5">
      <div class="col-md-8 mx-auto">
        <div class="card ">
<div class="card-header bg-primary">
            <h4 class="text-center text-white">Task Detail</h4>
</div>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary ml-auto mx-4 m-2 " data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-plus"> </i>  Add Task
  </button>


          <div class="card-body p-2 bg-white rounded">
            <div class="table-responsive">
                 @include('inc.messages')
              <table id="example" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Message</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($tasks)> 0)
                     @foreach ($tasks as $task)
                     <tr>
                        <td>
                            <p>#</p>
                        </td>
                        <td>{{ $task->title }}</td>
                        <td><img src="/images/{{ $task->image }}" class="img img-thumbnail" width="50px" height="50px"></td>
                        <td>{{ $task->content }}</td>
                        <td><a href="{{ route('task.edit',$task->id)}}" class="btn btn-primary"><i class="fas fa-edit"> </i></a></td>
                        <td>
                        <form action="{{ route('task.destroy', $task->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"> <i class="fas fa-trash-alt"> </i> </button>
                        </form>
                        </td>
                        </tr>
                     @endforeach
                     @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" >Add Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form" action="{{ route('task.store') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title name">
                </div>
                <div class="form-group">
                    <label for="file">Upload Image</label><br>
                                <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea2">
                        Message </label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="content"></textarea>
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

               </form>
        </div>

      </div>
    </div>
  </div>

  </div>
@endsection
