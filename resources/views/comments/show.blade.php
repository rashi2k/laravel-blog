@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-right">
      <a class="btn btn-primary" href="{{ route('comments.index') }}"> Back</a>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      <strong>{{ $comment->title }}</strong>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      {{ $comment->body }}
    </div>
  </div>
</div>
@endsection
