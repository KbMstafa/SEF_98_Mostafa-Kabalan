
@extends('layouts.auth')

@section('authContents')
<form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        
        <div class="col-md-8 col-md-offset-2">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

        <div class="col-md-8 col-md-offset-2">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

        <div class="col-md-8 col-md-offset-2">
            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required>
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

        <div class="col-md-8 col-md-offset-2">
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">

        <div class="col-md-8 col-md-offset-2">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-2">
            <button type="submit" class="btn btn-primary form-control">
                Register
            </button>
        </div>
    </div>
</form>
@endsection

@section('footer')
<a href="{{ route('login') }}">
    Already have an account?
    <b> Log in. </b>
</a>
@endsection