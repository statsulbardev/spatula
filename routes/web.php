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

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/dashboard', Index::class)->name('dashboard');

    Route::prefix('/verifikasi/')->group(function() {
        Route::get('selesai', CompleteList::class)->name('daftar-selesai');
        Route::get('selesai/{customer}', CompleteItem::class)->name('detail-selesai');
        Route::get('pj-layanan', ServiceResponsibleList::class)->name('daftar-pj-layanan');
        Route::get('pj-layanan/kategorisasi/{pengguna_layanan}', ServiceCategorization::class)->name('tambah-kategorisasi-layanan');
        Route::get('pj-layanan/kategorisasi/{pengguna_layanan}/edit', ServiceCategorization::class)->name('edit-kategorisasi-layanan');
        Route::get('pj-pengaduan', ComplaintResponsibleList::class)->name('daftar-pj-pengaduan');
        Route::get('pj-pengaduan/{customer}', ComplaintItem::class)->name('detail-pj-pengaduan');
    });

    Route::prefix('/laporan/')->group(function () {
        Route::get('bulanan', Monthly::class)->name('laporan-bulanan');
        Route::get('harian', Daily::class)->name('laporan-harian');
    });

    Route::prefix('/pengaturan/')->group(function () {
        Route::get('pengguna', UserList::class)->name('daftar-pengguna');
        Route::get('pengguna/tambah', CreateEditUser::class)->name('tambah-pengguna');
        Route::get('pengguna/{pengguna}/edit', CreateEditUser::class)->name('edit-pengguna');
        Route::get('layanan', ServiceList::class)->name('daftar-layanan');
        Route::get('layanan/tambah', CreateEditService::class)->name('tambah-layanan');
        Route::get('layanan/{layanan}/edit', CreateEditService::class)->name('edit-layanan');
        Route::get('satker', UnitList::class)->name('daftar-satker');
        Route::get('satker/tambah', CreateEditUnit::class)->name('tambah-satker');
        Route::get('satker/{satker}/edit', CreateEditUnit::class)->name('edit-satker');
    });
});
