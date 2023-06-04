<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard\Index;
use App\Http\Livewire\Verification\CompleteList;
use App\Http\Livewire\Verification\CompleteItem;
use App\Http\Livewire\Verification\ServiceResponsibleList;
use App\Http\Livewire\Verification\ServiceCategorization;
use App\Http\Livewire\Verification\ComplaintResponsibleList;
use App\Http\Livewire\Verification\ComplaintItem;
use App\Http\Livewire\Report\Monthly;
use App\Http\Livewire\Report\Daily;
use App\Http\Livewire\Configuration\UserList;
use App\Http\Livewire\Configuration\CreateEditUser;
use App\Http\Livewire\Configuration\ServiceList;
use App\Http\Livewire\Configuration\CreateEditService;
use App\Http\Livewire\Configuration\UnitList;
use App\Http\Livewire\Configuration\CreateEditUnit;
use App\Http\Livewire\Form\Evaluation;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'penilaian');

Route::get('sso', [LoginController::class, 'sso'])->name('sso');
Route::get('/login', Login::class)->name('login');

Route::get('/penilaian', Evaluation::class)->name('form-penilaian');

// Dashboard
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', Index::class)->name('dashboard');
});

// Verification
Route::group(['middleware' => ['auth', 'role:superadmin|admin|pj-layanan|pj-pengaduan']], function () {
    Route::prefix('/verifikasi/')->group(function() {
        Route::get('selesai', CompleteList::class)->name('daftar-selesai');
        Route::get('selesai/{customer}', CompleteItem::class)->name('detail-selesai');
        Route::get('pj-layanan', ServiceResponsibleList::class)->name('daftar-pj-layanan');
        Route::get('pj-layanan/kategorisasi/{pengguna_layanan}', ServiceCategorization::class)->name('tambah-kategorisasi-layanan');
        Route::get('pj-layanan/kategorisasi/{pengguna_layanan}/edit', ServiceCategorization::class)->name('edit-kategorisasi-layanan');
        Route::get('pj-pengaduan', ComplaintResponsibleList::class)->name('daftar-pj-pengaduan');
        Route::get('pj-pengaduan/{customer}', ComplaintItem::class)->name('detail-pj-pengaduan');
    });
});

// Report
Route::group(['middleware' => ['auth', 'role:superadmin|admin|pimpinan']], function () {
    Route::get('/laporan/bulanan', Monthly::class)->name('laporan-bulanan');
    Route::get('/laporan/harian', Daily::class)->name('laporan-harian');
});

// Configuration
Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/pengaturan/layanan', ServiceList::class)->name('daftar-layanan');
    Route::get('/pengaturan/layanan/tambah', CreateEditService::class)->name('tambah-layanan');
    Route::get('/pengaturan/layanan/{layanan}/edit', CreateEditService::class)->name('edit-layanan');
    Route::get('/pengaturan/satker', UnitList::class)->name('daftar-satker');
    Route::get('/pengaturan/satker/tambah', CreateEditUnit::class)->name('tambah-satker');
    Route::get('/pengaturan/satker/{satker}/edit', CreateEditUnit::class)->name('edit-satker');
});

// User Configuration
Route::group(['middleware' => ['auth', 'role:superadmin|admin']], function() {
    Route::get('/pengaturan/pengguna', UserList::class)->name('daftar-pengguna');
    Route::get('/pengaturan/pengguna/tambah', CreateEditUser::class)->name('tambah-pengguna');
    Route::get('/pengaturan/pengguna/{pengguna}/edit', CreateEditUser::class)->name('edit-pengguna');
});
