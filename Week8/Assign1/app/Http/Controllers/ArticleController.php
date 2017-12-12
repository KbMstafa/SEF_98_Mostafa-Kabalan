<?php

namespace BoxBlog\Http\Controllers;

use Illuminate\Http\Request;
use BoxBlog\Article;

class ArticleController extends Controller
{
    function all() {
        $data = array(
            "articles" => Article::orderBy('created_at', 'desc')->paginate(5)
        );
        return view("articles", $data);
    }

    function onId($id) {
        $data = array(
            "article" => \BoxBlog\Article::find($id)
        );
        return view("article", $data);
    }

    function createArticle() {
        return view('create');
    }

    function postArticle (Request $request) {
        $article = new Article();
        $article->article_title = $request->get('title');
        $article->article_text = $request->get('text');
        $id = \Auth::user()->id;
        $article->article_author_id = $id;
        $article->save();
        return redirect("/home/$id");
    }
}
