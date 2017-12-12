@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default" >

                    <div class="panel-body">
                        
                            <h1> {{ $article->article_title }} </h1>
                            <textarea class="view" disabled="true" id="artiii"> {{ $article->article_text }} </textarea>
                        
                    </div>

                    <div class="panel-heading">

                        By: <label>{{ $article->author->name }}</label>

                    </div>

                </div>

        </div>
    </div>
</div>
@endsection