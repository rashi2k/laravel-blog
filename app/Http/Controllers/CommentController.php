<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function __construct()
  {
    $this->middleware('permission:comment-list|comment-create|comment-edit|comment-delete', ['only' => ['index', 'show']]);
    $this->middleware('permission:comment-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:comment-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:comment-delete', ['only' => ['destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $comments = Comment::latest()->paginate(5);
    return view('comments.index', compact('comments'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('comments.create');
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
      'body' => 'required',
    ]);

    $comment = new Comment();
    $comment->on_post = $request->get('on_post');
    $comment->body = $request->get('body');
    $comment->from_user = $request->user()->id;

    $comment->save();

    return redirect($request->input('url'))
      ->with('success', 'Comment created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function show(Comment $comment)
  {
    return view('comments.show', compact('comment'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function edit(Comment $comment)
  {
    return view('comments.edit', compact('comment'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Comment $comment)
  {
    request()->validate([
      'title' => 'required',
      'body' => 'required',
    ]);

    $comment->update($request->all());

    return redirect()->route('comments.index')
      ->with('success', 'Comment updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $comment)
  {
    $comment->delete();

    return back()
      ->with('success', 'Comment deleted successfully');
  }
}
