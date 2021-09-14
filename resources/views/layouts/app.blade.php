<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.header')

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- ALERT-->
                    @if(Session::has('msg-success'))
                        <div class="alert alert-success alert-dismissable fade show flash_alert">
                            {!! Session::get('msg-success') !!}
                        </div>
                    @elseif(Session::has('msg-error'))
                        <div class="alert alert-danger alert-dismissable fade show flash_alert">
                            {!! Session::get('msg-error') !!}
                        </div>
                    @endif
                </div>
            </div>
            @yield('content')
        </main>
    </div>

@include('layouts.footer')
</body>
</html>
