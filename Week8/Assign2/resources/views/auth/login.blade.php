@extends('layouts.auth')

@section('authContents')
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

        <div class="col-md-8 col-md-offset-2">
            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email or username" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
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
            <button type="submit" class="btn btn-primary form-control" id="loginButton">
                Login
            </button>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-3">
            <a class="btn btn-link" id="forgotPass" href="{{ route('password.request') }}">
                Forgot your login details?
                <b> Get help signing in. </b>
            </a>
        </div>
    </div>
</form>
@endsection

@section('footer')
<a href="{{ route('register') }}">
    Don't have an account?
    <b> Sign up. </b>
</a>
@endsection

