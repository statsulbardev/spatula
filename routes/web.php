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
use App\Livewire\Configuration\Service\ServiceList;
use App\Livewire\Configuration\Service\ServiceBuilder;
use App\Livewire\Configuration\Service\UnitServiceList;
use App\Livewire\Configuration\Service\UnitServiceBuilder;
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
use App\Livewire\Antrian\NonAdmin\AuthLoginAntrian;
use App\Livewire\Antrian\NonAdmin\AuthRegistrasiAntrian;
use App\Livewire\Antrian\NonAdmin\DashboardAntrian;
use App\Livewire\Antrian\NonAdmin\ItemLihatTambahUbah;
use App\Livewire\Antrian\NonAdmin\LihatAntrian;


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
Route::middleware(['auth', 'role:superadmin|admin'])->prefix('/pengaturan/')->group(function () {
    Route::name('service.')->group(function() {
        Route::get('layanan', ServiceList::class)->name('index');
        Route::get('layanan/baru', ServiceBuilder::class)->name('create');
        Route::get('layanan/{layanan}/edit', ServiceBuilder::class)->name('edit');
    });

    Route::name('unit.')->group(function() {

    });

    Route::get('satker', UnitList::class)->name('daftar-satker');
    Route::get('satker/tambah', CreateEditUnit::class)->name('tambah-satker');
    Route::get('satker/{satker}/edit', CreateEditUnit::class)->name('edit-satker');
});

// User Configuration
Route::group(['middleware' => ['auth', 'role:superadmin|admin']], function () {
    Route::get('/pengaturan/pengguna', UserList::class)->name('daftar-pengguna');
    Route::get('/pengaturan/pengguna/tambah', CreateEditUser::class)->name('tambah-pengguna');
    Route::get('/pengaturan/pengguna/{pengguna}/edit', CreateEditUser::class)->name('edit-pengguna');
});


Route::group(['middleware' => ['auth', 'role:superadmin|admin|pj-antrian']], function () {
    Route::get('/pengaturan/antrian/daftar-layanan', DaftarLayanan::class)->name('antrian-daftar-layanan');
    Route::get('/pengaturan/antrian/config_view', Konfigurasi::class)->name('antrian-config-view');
});
Route::group(['middleware' => ['auth', 'role:superadmin|admin|pj-antrian|operator-antrian']], function () {
    Route::get('/pengaturan/antrian/daftar', DaftarAntrian::class)->name('antrian-daftar');
    // Route::get('/pengaturan/antrian/{id}/daftar', DaftarAntrianLihat::class)->name('antrian-daftar-lihat');
    Route::get('/pengaturan/antrian/caller', Pemanggil::class)->name('antrian-caller');
});

Route::redirect('/antrian', 'antrian/dashboard');
Route::get('/antrian/dashboard', DashboardAntrian::class)->name('antrian-non-admin-dashboard');
Route::get('/antrian/login', AuthLoginAntrian::class)->name('antrian-non-admin-auth-login');
Route::get('/antrian/registrasi', AuthRegistrasiAntrian::class)->name('antrian-non-admin-auth-registrasi');
Route::get('/antrian/logout', function () {
    session()->forget([
        'check_have_antrian_auth',
        'konsumen_email',
        'konsumen_no_wa_telepon',
        'konsumen_tahun_lahir',
        'konsumen_nama',
        'is_registrasi',
        'kode_satker_active'
    ]);
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('antrian-non-admin-auth-login');
})->name('antrian-non-admin-auth-logout');

Route::group(['middleware' => ['auth_antrian']], function () {
    Route::get('/antrian/lihat', LihatAntrian::class)->name('antrian-non-admin-lihat');
    Route::get('/antrian/tambah', ItemLihatTambahUbah::class)->name('antrian-non-admin-item-tambah');
    Route::get('/antrian/{antrian_satker}/edit', ItemLihatTambahUbah::class)->name('antrian-non-admin-item-edit');
    Route::get('/antrian/{antrian_satker}/lihat', ItemLihatTambahUbah::class)->name('antrian-non-admin-item-lihat');
});
