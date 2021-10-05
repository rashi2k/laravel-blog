<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function __construct()
  {
    $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index']]);
    $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:post-delete', ['only' => ['destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::latest()->paginate(5);
    return view('posts.index', compact('posts'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('posts.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    request()->validate([
      'title' => 'required',
      'body' => 'required',
    ]);

    $post = new Post();
    $post->title = $request->get('title');
    $post->body = $request->get('body');
    $post->author_id = $request->user()->id;
    $post->active = $request->get('active');

    Post::create($request->all());

    return redirect()->route('posts.index')
      ->with('success', 'Post created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    $post = Post::where('id',$id)->first();
    return view('posts.show', compact('post'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    return view('posts.edit', compact('post'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    request()->validate([
      'title' => 'required',
      'body' => 'required',
    ]);

    
    $post->title =  $request->input('title');
    $post->body = $request->input('body');
    $post->save();

    return redirect($request->input('url'))
      ->with('success', 'Post updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    $post->delete();

    return redirect()->route('posts.index')
      ->with('success', 'Post deleted successfully');
  }

}
