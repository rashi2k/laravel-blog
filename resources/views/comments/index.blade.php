@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>comments</h2>
    </div>
  </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
  <tr>
    <th></th>
    <th>Post</th>
    <th>Comments</th>
    <th width="280px">Action</th>
  </tr>
  @foreach ($comments as $comment)
  <tr>
    @if($comment->from_user == Auth::user()->id || Auth::user()->is_admin())
    <td>{{ ++$i }}</td>
    <td>{{ $comment->post->title }}</td>
    <td>{{ $comment->body }}</td>
    <td>
      <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
        <a class="btn btn-info" href="{{ route('comments.show',$comment->id) }}">Show</a>
        @can('comment-edit')
        <a class="btn btn-primary" href="{{ route('comments.edit',$comment->id) }}">Edit</a>
        @endcan
        @csrf
        @method('DELETE')
        @can('comment-delete')
        <button type="submit" class="btn btn-danger">Delete</button>
        @endcan
      </form>
    </td>
    @endif
  </tr>
  @endforeach
</table>


{!! $comments->links() !!}


@endsection