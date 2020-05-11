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
    Route::get('petugas/tambah', 'MPetugasController@create')->name('petugas.tambah');
    Route::post('petugas', 'MPetugasController@store')->name('petugas.simpan');
    Route::get('petugas/{id}/edit', 'MPetugasController@edit')->name('petugas.edit');
    Route::put('petugas/{id}', 'MPetugasController@update')->name('petugas.update');
    Route::delete('petugas/{id}', 'MPetugasController@destroy')->name('petugas.hapus');
});
