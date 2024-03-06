<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Spatula</title>

    <!-- Favicon-->
    <link id="favicon" rel="icon" href="{{ secure_asset(env('APP_URL') . '/public/files/logo_2.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@200..900&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/vendor/star-rating/star-rating.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/vendor/trix/trix-editor.min.css') }}">


    @yield('styles')

    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body
    x-data="{ 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">

    @yield('content')
    
    @vite(['resources/js/app.js'])
    @livewireScriptConfig

    <!-- <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
            data-turbolinks-eval="false"
            data-turbo-eval="false"> -->
    </script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/star-rating/star-rating.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/trix/trix-editor.min.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/star-rating/star-rating.min.js') }}"></script>

    @stack('scripts')
    
</body>

</html>
