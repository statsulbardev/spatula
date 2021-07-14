@if (session()->has('message'))
    <div class="alert alert-primary alert-dismissible show fade" role="alert">
        <strong>Notifikasi!</strong> {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
