@extends('layouts.app')

@section('create')
<a href="{{ URL::to('/') }}/create"> Create Article </a>
@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            @foreach ($articles as $article)

                <div class="panel panel-default articles" id="{{ $article->id }}" >

                    <div class="panel-body">
                        
                            <h1> {{ $article->article_title }} </h1>
                        
                    </div>

                    <div class="panel-heading">

                        By: <label>{{ $article->author->name }}</label>

                    </div>

                </div>
            @endforeach

            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
