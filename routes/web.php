<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard\Index;
use App\Http\Livewire\TindakLanjut\Selesai\DaftarSelesai;
use App\Http\Livewire\TindakLanjut\Selesai\DetailSelesai;
use App\Http\Livewire\TindakLanjut\PjLayanan\DaftarPjLayanan;
use App\Http\Livewire\TindakLanjut\PjLayanan\KategorisasiLayanan;
use App\Http\Livewire\TindakLanjut\PjPengaduan\DaftarPjPengaduan;
use App\Http\Livewire\Laporan\LaporanHarian;
use App\Http\Livewire\Laporan\LaporanBulanan;
use App\Http\Livewire\Pengaturan\Petugas\DaftarPetugas;
use App\Http\Livewire\Pengaturan\Pengguna\DaftarPengguna;
use App\Http\Livewire\Pengaturan\Pengguna\TambahEditPengguna;
use App\Http\Livewire\Pengaturan\Layanan\DaftarLayanan;
use App\Http\Livewire\Pengaturan\Layanan\TambahEditLayanan;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('sso', [LoginController::class, 'sso'])->name('sso');
Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', Index::class)->name('dashboard');

    Route::get('tindak-lanjut/selesai', DaftarSelesai::class);
    Route::get('tindak-lanjut/selesai/{id}', DetailSelesai::class);
    Route::get('tindak-lanjut/pj-layanan', DaftarPjLayanan::class);
    Route::get('tindak-lanjut/pj-layanan/kategorisasi/{id}', KategorisasiLayanan::class);
    Route::get('tindak-lanjut/pj-layanan/kategorisasi/{id}/edit', KategorisasiLayanan::class);
    Route::get('tindak-lanjut/pj-pengaduan', DaftarPjPengaduan::class);

    Route::prefix('laporan/')->group(function () {
        Route::get('harian', LaporanHarian::class)->name('laporan-harian');
        Route::get('bulanan', LaporanBulanan::class)->name('laporan-bulanan');
    });

    Route::prefix('pengaturan/')->group(function () {
        Route::get('petugas', DaftarPetugas::class);
        Route::get('pengguna', DaftarPengguna::class);
        Route::get('pengguna/tambah', TambahEditPengguna::class)->name('tambah-pengguna');
        Route::get('pengguna/{pengguna}/edit', TambahEditPengguna::class)->name('edit-pengguna');
        Route::get('layanan', DaftarLayanan::class)->name('daftar-layanan');
        Route::get('layanan/tambah', TambahEditLayanan::class)->name('tambah-layanan');
        Route::get('layanan/{layanan}/edit', TambahEditLayanan::class)->name('edit-layanan');
    });
});
