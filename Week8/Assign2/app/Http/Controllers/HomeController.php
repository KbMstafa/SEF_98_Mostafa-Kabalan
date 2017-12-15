<?php

namespace Instagram\Http\Controllers;

use Illuminate\Http\Request;
use Instagram\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \Auth::user()->id;
        $posts = Post::where('user_id', "=", $id)->orderBy('created_at', 'desc')->get();
        return view('home')->with('posts', $posts);
    }
}
