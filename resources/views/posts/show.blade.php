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
  <tr>
    <td style="width: 85%;border-top:none;"><strong>{{ $post->title }}<strong></td>
    <td style="border-top:none">
      @can('post-edit')
      @if($post->author_id == Auth::user()->id || Auth::user()->is_admin())
      <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
      @endif
      @endcan
    </td style="border-top:none">
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
    <td style="border-top:none"> {!! Str::limit($post->body, $limit = 500, $end = '....... <a href='.url("/posts/".$post->id).'>Read More</a>') !!}</td>
    <td style="border-top:none">
      <p> {{ $post->created_at->format('M d,Y \a\t h:i a') }} <br />By <a href="{{ url('/users/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
    </td>
  </tr>

  @if(Auth::guest())
  <td>
    <a href="{{ url('/login')}}">Login to Comment</a>
  </td>
  @endif
  @if(!Auth::guest())
  <td>
    <div>
      <h6>Leave a comment</h6>
    </div>
    <div class="panel-body">
      <form method="post" action="/comments/add">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="url" value="{{ URL::current() }}">
        <input type="hidden" name="on_post" value="{{ $post->id }}">
        <input type="hidden" name="from_user" value="{{Auth::user()->id}}">
        <div class="form-group">
          <textarea required="required" placeholder="Enter comment here" name="body" class="form-control"></textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Post" />
      </form>
    </div>
    @endif
  </td>
  </tr>
  <tr>
    @if(count($post->comments) > 0)<td>{{count($post->comments)}} comment(s)</td>@endif
  </tr>
  <tr>
  <tr>
    <td>
      <table class="table">
        @if(count($post->comments) > 0)
        @foreach($post->comments as $comment)
        <tr>
          <td style="width: 80%">
            <div>
              <p>{{ $comment->body }}</p>
            </div>
          </td>
          <td>
            <div>
              <h6>{{ $comment->author->name }}</h6>
              <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
              @can('comment-delete')
              @if($comment->from_user == Auth::user()->id || Auth::user()->is_admin())
              {!! Form::open(['method' => 'DELETE','route' => ['comments.destroy', $comment],'style'=>'display:inline']) !!}
              {{ Form::hidden('url', URL::previous())  }}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
              @endif
              @endcan
            </div>
          </td>
        </tr>
        @endforeach
        @endif
      </table>
    </td>
  </tr>

</table>


@endsection