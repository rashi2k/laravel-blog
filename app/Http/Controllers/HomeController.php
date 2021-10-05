<?php
    
namespace App\Http\Controllers;
    
use App\Models\Post;
use Illuminate\Http\Request;
    
class HomeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('home',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}