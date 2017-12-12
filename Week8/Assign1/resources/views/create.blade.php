@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >
                <div class="panel-body">
                    <form action="{{ Request::url() }}" method="POST">
                        <label class="labels">Title :</label>
                        <br>
                        <input  id="articleTitle" type="text" name="title" placeholder="Enter a title">
                        <br>
                        <label id="labels">Text :</label>
                        <br>
                        <textarea id="articleText" placeholder="Write the text...." name="text"></textarea>
                        <br>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="Submit" id="btnCreate">CREATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection