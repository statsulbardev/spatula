@extends('layouts.base')

@section('content')
    <div class="container mx-auto">
        {{ $slot }}
    </div>
    <footer class="bottom-0 mt-10 mb-6 text-light text-center leading-tight">
        <p class="lg:text-lg sm:text-sm">Copyright &copy; {{ date('Y') }} - <b class="text-primary-500">BPS Provinsi
                Sulawesi Barat</b></p>
        <span class="lg:text-sm sm:text-xs text-zinc-500">Jl. RE Martadinata No. 10, Mamuju, Telp. (0426) 21265, Fax (0426)
            22103, Mailbox : sulbar@bps.go.id, WhatsApp: 0822-9338-2522</span>
    </footer>
@overwrite
