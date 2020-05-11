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

    // Tautan Route

    // Tindak Lanjut - Selesai Route
    Route::get('tindak-lanjut/selesai', 'FollowUpController@done')->name('followup.done');
    Route::get('tindak-lanjut/{id}/selesai', 'FollowUpController@showDone')->name('followup.detail.done');
});
