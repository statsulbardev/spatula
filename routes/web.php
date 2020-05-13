<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login.attempt')->middleware('guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Pengguna Route
    Route::get('pengguna', 'MPenggunaController@index')->name('pengguna');
    Route::get('pengguna/tambah', 'MPenggunaController@create')->name('pengguna.tambah');
    Route::post('pengguna', 'MPenggunaController@store')->name('pengguna.simpan');
    Route::get('pengguna/{id}/edit', 'MPenggunaController@edit')->name('pengguna.edit');
    Route::put('pengguna/{id}', 'MPenggunaController@update')->name('pengguna.update');
    Route::delete('pengguna/{id}', 'MPenggunaController@destroy')->name('pengguna.hapus');

    // Petugas Route
    Route::get('petugas', 'MPetugasController@index')->name('petugas');
    Route::put('petugas/{id}', 'MPetugasController@update')->name('petugas.update');

    // Tautan/Link Route

    // Tindak Lanjut - Selesai Route
    Route::get('tindak-lanjut/selesai', 'FollowUpController@done')->name('followup.done');
    Route::get('tindak-lanjut/selesai/{id}', 'FollowUpController@showDone')->name('followup.detail.done');

    // Tindak Lanjut - Konfirmasi PJ Layanan
    Route::get('tindak-lanjut/konfirmasi-pj-layanan', 'FollowUpController@service')->name('followup.service');
    Route::get('tindak-lanjut/kategorisasi/{id}', 'FollowUpController@categorize')->name('followup.categorize');
    Route::put('tindak-lanjut/kategorisasi/{id}', 'FollowUpController@storeCategory')->name('followup.categorize.store');
    Route::get('tindak-lanjut/kirim/{id}', 'FollowUpController@sentPage')->name('followup.sent');
    Route::put('tindak-lanjut/kirim/{id}', 'FollowUpController@storeSent')->name('followup.sent.store');
    Route::put('tindak-lanjut/akhiri/{id}', 'FollowUpController@finish')->name('followup.finish');

    // Tindak Lanjut - Konfirmasi PJ Pengaduan
    Route::get('tindak-lanjut/konfirmasi-pj-pengaduan', 'FollowUpController@complaint')->name('followup.complaint');
    Route::get('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@sentComplaint')->name('followup.sent.complaint');
    Route::put('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@sentComplaintStore')->name('followup.sent.complaint.store');

    // Laporan Bulanan Route
    Route::get('laporan/bulanan', 'ReportController@monthly')->name('report.monthly');
    Route::get('laporan/harian', 'ReportController@daily')->name('report.daily');
    Route::post('laporan/harian', 'ReportController@showDailyDetail')->name('report.daily.show');
});
