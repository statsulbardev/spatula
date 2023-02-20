@extends('layouts.base')

@section('content')
    <div class="page login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex align-items-center">
                            <div class="content">
                                <div class="logo">
                                    <h1>SPATULA</h1>
                                </div>
                                <p>Saran Pengaduan Online dan Rating Pelayanan Petugas</p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                {{-- <div class="mb-5">
                                    <p class="h3 text-dark mb-4">SIGN IN APLIKASI SPATULA</p>
                                    <a class="mb-3 btn btn-sm btn-outline-primary" href="{{ route('sso') }}">
                                        Gunakan Akun Community BPS
                                    </a>
                                </div> --}}

                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@overwrite
