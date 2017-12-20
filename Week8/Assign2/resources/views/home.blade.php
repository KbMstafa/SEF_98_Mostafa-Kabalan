@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($posts as $post)

                <div class="panel panel-default">

                    <div class="panel-body">
                        
                        <div class="row">

                            <img class="col-md-8 col-md-offset-2" src="{{ asset('storage/'.$post->image_path) }}">
                        </div>

                        <div class="row">
                            <h1 class="col-md-6 col-md-offset-4"> {{ $post->caption }} </h1>
                        </div>

                       <!--  <img src="{{ asset(Storage::url('$post->image_path')) }}" /> -->

                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection