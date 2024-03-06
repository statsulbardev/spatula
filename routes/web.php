<?php

use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Auth\Login;
use App\Livewire\Verification\CompleteList;
use App\Livewire\Verification\CompleteItem;
use App\Livewire\Verification\ServiceResponsibleList;
use App\Livewire\Verification\ServiceCategorization;
use App\Livewire\Verification\ComplaintResponsibleList;
use App\Livewire\Verification\ComplaintItem;
use App\Livewire\Report\Monthly;
use App\Livewire\Report\Daily;
use App\Livewire\Configuration\UserList;
use App\Livewire\Configuration\CreateEditUser;
use App\Livewire\Configuration\ServiceList;
use App\Livewire\Configuration\CreateEditService;
use App\Livewire\Configuration\UnitList;
use App\Livewire\Configuration\CreateEditUnit;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Form\Evaluation;
use Illuminate\Support\Facades\Route;

use App\Livewire\Antrian\Admin\DaftarLayanan;
use App\Livewire\Antrian\Admin\Konfigurasi;
use App\Livewire\Antrian\Admin\Pemanggil;
use App\Livewire\Antrian\Admin\DaftarAntrian;
use App\Livewire\Antrian\Admin\DaftarAntrianLihat;
use App\Livewire\Antrian\NonAdmin\AuthAntrian;
use App\Livewire\Antrian\NonAdmin\DashboardAntrian;
use App\Livewire\Antrian\NonAdmin\ItemLihatTambahUbah;
use App\Livewire\Antrian\NonAdmin\LihatAntrian;
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/spatula/livewire/update', $handle);
});
// Livewire::setScriptRoute(function ($handle) {
//     return Route::get('/spatula/livewire/livewire.js', $handle);
// });

Route::redirect('/', 'penilaian');

Route::get('sso', [LoginController::class, 'sso'])->name('sso');
Route::get('/login', Login::class)->name('login');

Route::get('/penilaian', Evaluation::class)->name('form-penilaian');

// Dashboard
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

// Verification
Route::group(['middleware' => ['auth', 'role:superadmin|admin|pj-layanan|pj-pengaduan']], function () {
    Route::prefix('/verifikasi/')->group(function () {
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
Route::group(['middleware' => ['auth', 'role:superadmin|admin']], function () {
    Route::get('/pengaturan/pengguna', UserList::class)->name('daftar-pengguna');
    Route::get('/pengaturan/pengguna/tambah', CreateEditUser::class)->name('tambah-pengguna');
    Route::get('/pengaturan/pengguna/{pengguna}/edit', CreateEditUser::class)->name('edit-pengguna');
});


Route::group(['middleware' => ['auth', 'role:admin|pj-antrian']], function () {
    Route::get('/pengaturan/antrian/daftar-layanan', DaftarLayanan::class)->name('antrian-daftar-layanan');
    Route::get('/pengaturan/antrian/config_view', Konfigurasi::class)->name('antrian-config-view');
});
Route::group(['middleware' => ['auth', 'role:admin|pj-antrian|operator-antrian']], function () {
    Route::get('/pengaturan/antrian/daftar', DaftarAntrian::class)->name('antrian-daftar');
    Route::get('/pengaturan/antrian/{id}/daftar', DaftarAntrianLihat::class)->name('antrian-daftar-lihat');
    Route::get('/pengaturan/antrian/caller', Pemanggil::class)->name('antrian-caller');
});

Route::redirect('/antrian', 'antrian/dashboard');
Route::get('/antrian/dashboard', DashboardAntrian::class)->name('antrian-non-admin-dashboard');
Route::get('/antrian/auth', AuthAntrian::class)->name('antrian-non-admin-auth');
Route::get('/antrian/auth/logout', function () {
    session()->forget(['check_have_antrian_auth', 'konsumen_email', 'konsumen_no_wa_telepon', 'konsumen_tahun_lahir', 'konsumen_nama', 'is_registrasi']);
    return redirect()->route('antrian-non-admin-auth');
})->name('antrian-non-admin-auth-logout');

Route::group(['middleware' => ['auth_antrian']], function () {
    Route::get('/antrian/lihat', LihatAntrian::class)->name('antrian-non-admin-lihat');
    Route::get('/antrian/tambah', ItemLihatTambahUbah::class)->name('antrian-non-admin-item-tambah');
    Route::get('/antrian/{id_antrian}/edit', ItemLihatTambahUbah::class)->name('antrian-non-admin-item-edit');
    Route::get('/antrian/{id_antrian}/lihat', ItemLihatTambahUbah::class)->name('antrian-non-admin-item-lihat');
});
