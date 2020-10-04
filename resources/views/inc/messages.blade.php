
@if(count($errors) >0)
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{$error}}
</div>
@endforeach
@endif

@if(session('success'))
<div class="alert alert-success  alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{session('success')}}
</div>
@endif
