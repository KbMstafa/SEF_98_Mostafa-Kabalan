@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @php($articles = BlogMK\Article::all())
                    @foreach ($articles as $article)
                        <h3> {{ $article->article_title }} </h3>
                        <p> {{ $article->article_text }} </p>
                        {{ $article->author->name }}
                    @endforeach

                    <h1> Batata </h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection