<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Http\Livewire\Auth\Login::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Http\Livewire\Dashboard\Index::class);

    Route::prefix('followup')->group(function () {
        // Done
        Route::get('done/lists', \App\Http\Livewire\Followup\Done\Lists::class);
        Route::get('done/show/{id}', \App\Http\Livewire\Followup\Done\Show::class);

        // Service PIC
        Route::get('service/lists', \App\Http\Livewire\Followup\ServicePic\Lists::class);
        Route::get('service/show/{id}', \App\Http\Livewire\Followup\ServicePic\Show::class);
        Route::get('service/categorize/{id}', \App\Http\Livewire\Followup\ServicePic\CreateCategorize::class);
        Route::get('service/categorize/edit/{id}', \App\Http\Livewire\Followup\ServicePic\EditCategorize::class);
        Route::get('service/categorize/sent/{id}', \App\Http\Livewire\Followup\ServicePic\Sent::class);

        // Complain PIC
        Route::get('complaint/lists', \App\Http\Livewire\Followup\ComplaintPic\Lists::class);
    });

    Route::prefix('setting')->group(function () {
        // User Management
        Route::get('user/lists', \App\Http\Livewire\Setting\User\Lists::class);
        Route::get('user/create', \App\Http\Livewire\Setting\User\CreateEdit::class);
        Route::get('user/edit/{id}', \App\Http\Livewire\Setting\User\CreateEdit::class);

        // Officer Management
        Route::get('officer/lists', \App\Http\Livewire\Setting\Officer\Lists::class);
    });
});

// Route::get('sso', 'Auth\LoginController@sso')->name('sso');

// Route::prefix('penilaian')->name('penilaian.')->group(function() {
//     Route::get('{satker}/petugas/{layanan?}', 'FormPenilaianController@petugasForm')->name('petugas');
//     Route::get('{satker}/layanan/{layanan?}', 'FormPenilaianController@layananForm')->name('layanan');

//     Route::post('petugas/{satker}', 'FormPenilaianController@storePetugasForm')->name('petugas.store');
//     Route::post('layanan/{satker}', 'FormPenilaianController@storeLayananForm')->name('layanan.store');
// });

// Route::middleware('auth')->group(function() {
//     Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//     Route::get('tautan', 'LinkController@index')->name('tautan');

//     Route::put('tindak-lanjut/kirim/{id}', 'FollowUpController@simpanDataLayanan')->name('followup.sent.store');
//     Route::put('tindak-lanjut/akhiri/{id}', 'FollowUpController@akhiriKonfirmasiLayanan')->name('followup.finish');

//     Route::get('tindak-lanjut/konfirmasi-pj-pengaduan', 'FollowUpController@listPjPengaduan')->name('followup.complaint');
//     Route::get('tindak-lanjut/konfirmasi-pj-pengaduan/{id}', 'FollowUpController@detailPjPengaduan')->name('followup.detail.complaint');
//     Route::get('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@kirimDataPengaduan')->name('followup.sent.complaint');
//     Route::put('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@simpanDataPengaduan')->name('followup.sent.complaint.store');

//     Route::get('laporan/bulanan', 'ReportController@monthly')->name('report.monthly');
//     Route::post('laporan/bulanan', 'ReportController@showMonthlyDetail')->name('report.monthly.show');
//     Route::get('laporan/harian', 'ReportController@daily')->name('report.daily');
//     Route::post('laporan/harian', 'ReportController@showDailyDetail')->name('report.daily.show');

//     Route::get('panduan', 'PanduanController')->name('panduan');
// });
