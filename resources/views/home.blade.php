@extends('layouts.app')

@section('content')
    @include('partials.header')

    <div class="page-content d-flex align-items-stretch">
        @include('partials.navigation')

        <div class="content-inner">
            @yield('inner-content')

            @include('partials.footer')
        </div>
    </div>
@endsection
