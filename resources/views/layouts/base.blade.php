<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Spatula</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/css/fontastic.css') }}">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/css/style.default.css') }}">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ secure_asset(env('APP_URL') . '/img/favicon.ico') }}">

    @yield('styles')

    @livewireStyles
</head>
<body>
    @yield('content')

    @livewireScripts

    <!-- JavaScript files-->
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/js/charts-home.js') }}"></script>

    @include('sweetalert::alert')

    @stack('scripts')
</body>
</html>
