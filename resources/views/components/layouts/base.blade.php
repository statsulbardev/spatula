<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Spatula'}}</title>

    <!-- Favicon-->
    <link id="favicon" rel="icon" href="{{ secure_asset('public/files/logo_2.ico') }}"  data-navigate-once>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@200..900&display=swap"  data-navigate-once>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css"  data-navigate-once/>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css"   data-navigate-once/>
    <link rel="stylesheet" href="{{ secure_asset('/vendor/star-rating/star-rating.min.css') }}"  data-navigate-once>
    <link rel="stylesheet" href="{{ secure_asset('/vendor/trix/trix-editor.min.css') }}"  data-navigate-once>

    @livewireStyles

    @vite(['resources/css/app.css'])

    @yield('styles')

    <style>[x-cloak] { display: none !important }</style>
</head>

<body x-data="{page: 'spatula', 'loaded': true, 'sidebarToggle': false, 'scrollTop': false}">
    <x-notification.flash />

    @yield('content')

    @vite(['resources/js/app.js'])

    @livewireScriptConfig

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"  data-navigate-once></script>
    <script src="{{ secure_asset('public/vendor/star-rating/star-rating.min.js') }}" data-navigate-once></script>
    <script src="{{ secure_asset('public/vendor/trix/trix-editor.min.js') }}" data-navigate-once></script>
    <script src="{{ secure_asset('public/vendor/star-rating/star-rating.min.js') }}" data-navigate-once></script>
    <script data-navigate-once>
        window.addEventListener('notification', event => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: event.detail.message
            }));
        })
    </script>

    @stack('scripts')
</body>
</html>
