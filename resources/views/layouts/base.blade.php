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
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link rel="stylesheet" href="{{ secure_asset('vendor/trix/trix-editor.min.css') }}">

    @vite('resources/js/app.js')

    @yield('styles')

    @livewireStyles

    <style>[x-cloak] { display : none; }</style>
</head>
<body x-data class="h-screen mx-auto antialiased bg-gray-100 font-sans leading-none text-gray-700">

    @yield('content')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="{{ secure_asset('vendor/trix/trix-editor.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/star-rating/star-rating.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
