@extends('layouts.base')

@section('content')
    <div class="container mx-auto">
        {{ $slot }}
    </div>
    <footer class="text-light bottom-0 mb-6 mt-10 text-center leading-tight">
        <p class="text-sm lg:text-lg">Copyright &copy; {{ date('Y') }} -
            <b class="text-primary-500">BPS Provinsi Sulawesi Barat</b>
        </p>
        <span class="break-words text-zinc-500 text-xs lg:text-sm">
            Jl. RE Martadinata No. 10, Mamuju,
            Mailbox : sulbar@bps.go.id, WhatsApp: 0822-9338-2522
        </span>
    </footer>
@overwrite
