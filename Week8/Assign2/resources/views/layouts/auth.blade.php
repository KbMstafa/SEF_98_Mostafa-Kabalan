<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 authBackground" id="title">
                    <h1> Instagram </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2 authBackground" id="contentEnd">


                    <div class="panel-body">
                        @yield('authContents')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2 authBackground" id="auth">
                    @yield('footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
