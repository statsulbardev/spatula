<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login.attempt')->middleware('guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('sso', 'BpsSsoController')->name('sso');

Route::prefix('penilaian')->name('penilaian.')->group(function() {
    Route::get('{satker}/petugas/{layanan?}', 'FormPenilaianController@petugasForm')->name('petugas');
    Route::get('{satker}/layanan/{layanan?}', 'FormPenilaianController@layananForm')->name('layanan');

    Route::post('petugas/{satker}', 'FormPenilaianController@storePetugasForm')->name('petugas.store');
    Route::post('layanan/{satker}', 'FormPenilaianController@storeLayananForm')->name('layanan.store');
});

Route::middleware('auth')->group(function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('pengguna', 'MPenggunaController@index')->name('pengguna');
    Route::get('pengguna/tambah', 'MPenggunaController@create')->name('pengguna.tambah');
    Route::post('pengguna', 'MPenggunaController@store')->name('pengguna.simpan');
    Route::get('pengguna/{id}/edit', 'MPenggunaController@edit')->name('pengguna.edit');
    Route::put('pengguna/{id}', 'MPenggunaController@update')->name('pengguna.update');
    Route::delete('pengguna/{id}', 'MPenggunaController@destroy')->name('pengguna.hapus');

    Route::get('petugas', 'MPetugasController@index')->name('petugas');
    Route::put('petugas/{id}', 'MPetugasController@update')->name('petugas.update');

    Route::get('tautan', 'LinkController@index')->name('tautan');

    Route::get('tindak-lanjut/selesai', 'FollowUpController@selesai')->name('followup.done');
    Route::get('tindak-lanjut/selesai/{id}', 'FollowUpController@selesaiDetail')->name('followup.detail.done');

    Route::get('tindak-lanjut/konfirmasi-pj-layanan', 'FollowUpController@listPjLayanan')->name('followup.service');
    Route::get('tindak-lanjut/kategorisasi/{id}', 'FollowUpController@kategorisasi')->name('followup.categorize');
    Route::put('tindak-lanjut/kategorisasi/{id}', 'FollowUpController@simpanKategori')->name('followup.categorize.store');
    Route::get('tindak-lanjut/kategorisasi/{id}/edit', 'FollowUpController@editKategori')->name('followup.categorize.edit');
    Route::put('tindak-lanjut/kategorisasi/{id}/edit', 'FollowUpController@updateKategori')->name('followup.categorize.update');
    Route::get('tindak-lanjut/kirim/{id}', 'FollowUpController@kirimDataLayanan')->name('followup.sent');
    Route::put('tindak-lanjut/kirim/{id}', 'FollowUpController@simpanDataLayanan')->name('followup.sent.store');
    Route::put('tindak-lanjut/akhiri/{id}', 'FollowUpController@akhiriKonfirmasiLayanan')->name('followup.finish');

    Route::get('tindak-lanjut/konfirmasi-pj-pengaduan', 'FollowUpController@listPjPengaduan')->name('followup.complaint');
    Route::get('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@kirimDataPengaduan')->name('followup.sent.complaint');
    Route::put('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@simpanDataPengaduan')->name('followup.sent.complaint.store');

    Route::get('laporan/bulanan', 'ReportController@monthly')->name('report.monthly');
    Route::post('laporan/bulanan', 'ReportController@showMonthlyDetail')->name('report.monthly.show');
    Route::get('laporan/harian', 'ReportController@daily')->name('report.daily');
    Route::post('laporan/harian', 'ReportController@showDailyDetail')->name('report.daily.show');
});
