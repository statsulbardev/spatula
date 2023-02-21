<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard\Index;
use App\Http\Livewire\Followup\Done\Lists as DoneList;
use App\Http\Livewire\Followup\Done\Show as DoneShow;
use App\Http\Livewire\Followup\ServicePic\Lists as ServicePicList;
use App\Http\Livewire\Followup\ServicePic\Show as ServicePicShow;
use App\Http\Livewire\Followup\ServicePic\CreateCategorize;
use App\Http\Livewire\Followup\ServicePic\EditCategorize;
use App\Http\Livewire\Followup\ServicePic\Sent;
use App\Http\Livewire\Followup\ComplaintPic\Lists as ComplaintPicList;
use App\Http\Livewire\Followup\ComplaintPic\Show as ComplaintPicShow;
use App\Http\Livewire\Followup\ComplaintPic\Sent as ComplaintPicSent;
use App\Http\Livewire\Setting\User\Lists as UserList;
use App\Http\Livewire\Setting\User\CreateEdit as CreateEditUser;
use App\Http\Livewire\Setting\Officer\Lists as OfficerList;
use App\Http\Livewire\Report\Monthly;
use App\Http\Livewire\Report\Daily;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('login', Login::class)->name('login');

Route::group(['prefix' => 'penilaian'], function() {
    // Route::get('{satker}/petugas/{layanan?}', 'FormPenilaianController@petugasForm')->name('petugas');
//     Route::get('{satker}/layanan/{layanan?}', 'FormPenilaianController@layananForm')->name('layanan');

//     Route::post('petugas/{satker}', 'FormPenilaianController@storePetugasForm')->name('petugas.store');
//     Route::post('layanan/{satker}', 'FormPenilaianController@storeLayananForm')->name('layanan.store');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', Index::class)->name('dashboard');

    Route::group(['prefix' => 'followup'], function() {
        // Done
        Route::get('done/lists', DoneList::class)->name('list-done');
        Route::get('done/show/{id}', DoneShow::class)->name('list-done-show');

        // Service PIC
        Route::get('service/lists', ServicePicList::class)->name('service-pic-list');
        Route::get('service/show/{id}', ServicePicShow::class)->name('service-pic-show');
        Route::get('service/categorize/{id}', CreateCategorize::class)->name('service-pic-create-categorize');
        Route::get('service/categorize/edit/{id}', EditCategorize::class)->name('service-pic-edit-categorize');
        Route::get('service/categorize/sent/{id}', Sent::class)->name('service-pic-sent');

        // Complain PIC
        Route::get('complaint/lists', ComplaintPicList::class)->name('complaint-pic-list');
        Route::get('complaint/show/{id}', ComplaintPicShow::class)->name('complaint-pic-show');
        Route::get('complaint/sent/{id}', ComplaintPicSent::class)->name('complaint-pic-sent');
    });

    Route::group(['prefix' => 'setting'], function() {
        // User Management
        Route::get('user/lists', UserList::class)->name('user-list');
        Route::get('user/create', CreateEditUser::class)->name('create-user');
        Route::get('user/edit/{id}', CreateEditUser::class)->name('edit-user');

        // Officer Management
        Route::get('officer/lists', OfficerList::class)->name('officer-list');
    });

    Route::group(['prefix' => 'report'], function() {
        Route::get('monthly', Monthly::class)->name('report-monthly');
        Route::get('daily', Daily::class)->name('report-daily');
    });
});


// Route::middleware('auth')->group(function() {
//     Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//     Route::get('tautan', 'LinkController@index')->name('tautan');

//     Route::put('tindak-lanjut/kirim/{id}', 'FollowUpController@simpanDataLayanan')->name('followup.sent.store');
//     Route::put('tindak-lanjut/akhiri/{id}', 'FollowUpController@akhiriKonfirmasiLayanan')->name('followup.finish');

//     Route::get('tindak-lanjut/konfirmasi-pj-pengaduan', 'FollowUpController@listPjPengaduan')->name('followup.complaint');
//     Route::get('tindak-lanjut/konfirmasi-pj-pengaduan/{id}', 'FollowUpController@detailPjPengaduan')->name('followup.detail.complaint');
//     Route::get('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@kirimDataPengaduan')->name('followup.sent.complaint');
//     Route::put('tindak-lanjut/kirim-pengaduan/{id}', 'FollowUpController@simpanDataPengaduan')->name('followup.sent.complaint.store');



//     Route::get('panduan', 'PanduanController')->name('panduan');
// });
