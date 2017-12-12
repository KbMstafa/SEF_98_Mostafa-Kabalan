<?php

namespace BoxBlog\Http\Controllers;

use Illuminate\Http\Request;
use BoxBlog\Article;

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
        return redirect('articles');
    }

    public function userArticles($id) {
        $data = array(
            "articles" => Article::where('article_author_id', "=", $id)->orderBy('created_at', 'desc')->paginate(5)
        );
        return view("home", $data);
    }
}

