@extends('layouts.app')

@section('title', 'Login')

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
                            <div class="mb-5">
                                <p class="h3 text-dark mb-4">SIGN IN APLIKASI SPATULA</p>
                                <a class="mb-3 btn btn-sm btn-outline-primary" href="{{ route('sso') }}">
                                    Gunakan Akun Community BPS
                                </a>
                            </div>
                            <form method="POST" class="form-validate" action={{ route('login') }}>
                                @csrf
                                <hr class="mb-5 mt-5 divider">
                                <div class="form-group">
                                    <input id="username" type="text" name="username" required class="input-material">
                                    <label for="username" class="label-material">Username</label>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" name="password" required class="input-material">
                                    <label for="password" class="label-material">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/front.js') }}"></script>
@endpush
