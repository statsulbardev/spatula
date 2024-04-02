<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Spatula'}}</title>

    <!-- Favicon-->
    <link id="favicon" rel="icon" href="{{ secure_asset(env('APP_URL') . '/public/files/logo_2.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@200..900&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/vendor/star-rating/star-rating.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . '/vendor/trix/trix-editor.min.css') }}">

    @livewireStyles

    @vite(['resources/css/app.css'])

    @yield('styles')

    <style>[x-cloak] {display: none !important}</style>
</head>
<body>
    <x-notification.flash />

    @guest
        @switch(request()->route()->getName())
            @case('form-penilaian')
                <x-layouts.evaluation> {{ $slot }} </x-layouts.evaluation>
            @break

            @case('login')
                <x-layouts.auth> {{ $slot }} </x-layouts.auth>
            @break
        @endswitch
    @endguest

    @auth
        <div class="flex h-screen overflow-hidden">
            <x-partials.sidebar.sidebar />

            <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
                <x-partials.header />
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    @endauth

    @vite(['resources/js/app.js'])

    @livewireScriptConfig

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/star-rating/star-rating.min.js') }}" data-navigate-once></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/trix/trix-editor.min.js') }}" data-navigate-once></script>
    <script src="{{ secure_asset(env('APP_URL') . '/vendor/star-rating/star-rating.min.js') }}" data-navigate-once></script>
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
