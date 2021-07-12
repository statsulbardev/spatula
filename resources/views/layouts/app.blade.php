<x-layouts.base>
    @include('partials.header')

    <div class="page-content d-flex align-items-stretch">
        @include('partials.navigation')

        <div class="content-inner">
            {{ $slot }}

            @include('partials.footer')
        </div>
    </div>
</x-layouts.base>
