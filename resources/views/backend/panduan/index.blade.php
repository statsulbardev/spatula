@extends('home')

@section('title', 'Panduan Penggunaan')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
        <h2 class="no-margin-bottom">Panduan Penggunaan Aplikasi</h2>
        </div>
    </header>

    <!-- Dashboard Counts Section-->
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid text-center">
            <iframe src="{{ asset('public/vendor/ViewerJS/#../../files/pdf/panduan.pdf') }}" class="w-100 p-1 border rounded shadow mb-5" style="display:block;height:100vh;" allowfullscreen webkitallowfullscreen></iframe>
        </div>
      </section>
@endsection
