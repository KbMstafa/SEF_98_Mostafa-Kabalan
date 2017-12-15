@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($posts as $post)

                <div class="panel panel-default">

                    <div class="panel-body">
                        
                            <h1> {{ $post->caption }} </h1>
                        
                    </div>

                    <div class="panel-heading">

                        <img src="{{ asset('storage/'.$post->image_path) }}">

                       <!--  <img src="{{ asset(Storage::url('$post->image_path')) }}" /> -->

                        

                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection