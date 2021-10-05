@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <!-- <h2>Posts</h2> -->
    </div>
  </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table">

  @foreach ($posts as $post)
  <tr>
    <td><a href="{{ url('/posts/view/'.$post->id)}}"><strong>{{ $post->title }}<strong></a></td>
    <td>
      @can('post-edit')
        @if($post->author_id == Auth::user()->id || Auth::user()->is_admin())
        <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
        @endif
      @endcan
    </td>
    <!-- <td>
        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
          <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
          @can('post-edit')
          <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
          @endcan


          @csrf
          @method('DELETE')
          @can('post-delete')
          <button type="submit" class="btn btn-danger">Delete</button>
          @endcan
        </form>
      </td> -->
  </tr>
  <tr>
    <td> {!! Str::limit($post->body, $limit = 500, $end = '....... <a href='.url("/posts/view/".$post->id).'>Read More</a>') !!}</td>
    <td>
      <p> {{ $post->created_at->format('M d,Y \a\t h:i a') }} <br />By <a href="{{ url('/users/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
    <td>
  </tr>
  <tr>
    @if(count($post->comments) > 0)<td><a href="{{ url('/posts/view/'.$post->id)}}">{{count($post->comments)}} comment(s)</a></td>@endif
  </tr>
  @endforeach
</table>


{!! $posts->links() !!}


@endsection