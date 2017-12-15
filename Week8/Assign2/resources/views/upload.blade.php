@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-lg-offset-4 col-lg-4">
        <center><h1>Upload file</h1></center>
        <form class="form-horizontal" action="{{ route('upload') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="file" name="image">
            <br>
            <input class="btn btn-info" type="submit" value="Upload">
        </form>     
    </div>  
    </div>
</div>  
@endsection