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
            <canvas class="border rounded shadow" id="pdf_canvas"></canvas>
        </div>
      </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
    <script>
        pdfjsLib.getDocument("{{ asset('public/files/pdf/laravel.pdf') }}").then(doc => {
            doc.getPage(1).then(page => {
                let myCanvas = document.getElementById("pdf_canvas");
                let context  = myCanvas.getContext("2d");
                let viewport = page.getViewport(2);

                myCanvas.width  = viewport.width;
                myCanvas.height = viewport.height;

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        });
    </script>
@endpush
