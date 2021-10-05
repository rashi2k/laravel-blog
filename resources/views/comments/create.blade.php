@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Add New Comment</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-primary" href="{{ route('comments.index') }}"> Back</a>
    </div>
  </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


<form action="{{ route('comments.store') }}" method="POST">
  @csrf

  <input type="hidden" name="author_id" value="{{Auth::user()->id}}">
  <input type="hidden" name="active" value="0">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <!-- <strong>Title:</strong> -->
        <input type="text" name="title" class="form-control" placeholder="Title">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <textarea class="form-control" style="height:150px" name="body" placeholder="Write your comment here"></textarea>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>


</form>


@endsection