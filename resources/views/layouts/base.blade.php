<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Spatula</title>

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ secure_asset(env('APP_URL') . '/img/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />

    @vite('resources/js/app.js')

    @yield('styles')

    @livewireStyles
</head>
<body x-data class="antialiased bg-gray-100 font-sans leading-none text-gray-700">
    <style>
        [x-cloak] { display : none; }
    </style>
     @yield('content')

    @livewireScripts

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
</html>
