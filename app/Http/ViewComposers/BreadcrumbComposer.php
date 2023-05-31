<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class BreadcrumbComposer
{
    public function compose(View $view)
    {
        $data = [];

        $routeName = Route::currentRouteName();

        switch(true) {
            case stristr ($routeName, 'dashboard') :
                $data = [
                    'first_route' => route('dashboard'),
                    'first_label' => 'Dashboard'
                ];
                break;
            case stristr ($routeName, 'daftar-selesai') :
                $data = [
                    'first_route' => route('daftar-selesai'),
                    'first_label' => 'Hasil Verifikasi'
                ];
                break;
            case stristr ($routeName, 'detail-selesai') :
                $data = [
                    'first_route'  => route('daftar-selesai'),
                    'first_label'  => 'Hasil Verifikasi',
                    'second_route' => route('detail-selesai', request()->route()->originalParameters()),
                    'second_label' => request()->route()->parameters()['customer']['nama_konsumen']
                ];
                break;
            case stristr ($routeName, 'daftar-pj-layanan') :
                $data = [
                    'first_route' => route('daftar-pj-layanan'),
                    'first_label' => 'Daftar Verifikasi',
                ];
                break;
            case stristr ($routeName, 'tambah-kategorisasi-layanan') :
                $data = [
                    'first_route'  => route('daftar-pj-layanan'),
                    'first_label'  => 'Daftar Verifikasi',
                    'second_route' => route('tambah-kategorisasi-layanan', request()->route()->originalParameters()),
                    'second_label' => 'Kategorisasi Layanan',
                    'third_label'  => request()->route()->parameters()['pengguna_layanan']['nama_konsumen']
                ];
                break;
            case stristr ($routeName, 'edit-kategorisasi-layanan') :
                $data = [
                    'first_route'  => route('daftar-pj-layanan'),
                    'first_label'  => 'Daftar Verifikasi',
                    'second_route' => route('tambah-kategorisasi-layanan', request()->route()->originalParameters()),
                    'second_label' => 'Kategorisasi Layanan',
                    'third_label'  => request()->route()->parameters()['pengguna_layanan']['nama_konsumen']
                ];
                break;
            case stristr ($routeName, 'daftar-pj-pengaduan') :
                $data = [
                    'first_route' => route('daftar-pj-pengaduan'),
                    'first_label' => 'Daftar Verifikasi',
                ];
                break;
            case stristr ($routeName, 'detail-pj-pengaduan') :
                $data = [
                    'first_route'  => route('daftar-pj-pengaduan'),
                    'first_label'  => 'Daftar Verifikasi',
                    'second_route' => route('detail-pj-pengaduan', request()->route()->originalParameters()),
                    'second_label' => 'Verifikasi Pengaduan',
                    'third_label'  => request()->route()->parameters()['customer']['nama_konsumen']
                ];
                break;
            case stristr ($routeName, 'laporan-bulanan') :
                $data = [
                    'first_route' => route('laporan-bulanan'),
                    'first_label' => 'Laporan',
                    'third_label' => 'Bulanan'
                ];
                break;
            case stristr ($routeName, 'laporan-harian') :
                $data = [
                    'first_route' => route('laporan-harian'),
                    'first_label' => 'Laporan',
                    'third_label' => 'Harian'
                ];
                break;
            case stristr ($routeName, 'daftar-pengguna') :
                $data = [
                    'first_route' => route('daftar-pengguna'),
                    'first_label' => 'Daftar Pengguna'
                ];
                break;
            case stristr ($routeName, 'tambah-pengguna') :
                $data = [
                    'first_route' => route('daftar-pengguna'),
                    'first_label' => 'Daftar pengguna',
                    'third_label' => 'Pengguna Baru'
                ];
                break;
            case stristr ($routeName, 'edit-pengguna') :
                $data = [
                    'first_route'  => route('daftar-pengguna'),
                    'first_label'  => 'Daftar Pengguna',
                    'second_route' => route('edit-pengguna', request()->route()->originalParameters()),
                    'second_label' => 'Edit Pengguna',
                    'third_label'  => request()->route()->parameters()['pengguna']['nama']
                ];
                break;
            case stristr ($routeName, 'daftar-layanan') :
                $data = [
                    'first_route' => route('daftar-layanan'),
                    'first_label' => 'Daftar Layanan'
                ];
                break;
            case stristr ($routeName, 'tambah-layanan') :
                $data = [
                    'first_route' => route('daftar-layanan'),
                    'first_label' => 'Daftar Layanan',
                    'third_label' => 'Tambah Layanan'
                ];
                break;
            case stristr ($routeName, 'edit-layanan') :
                $data = [
                    'first_route'  => route('daftar-layanan'),
                    'first_label'  => 'Daftar Layanan',
                    'second_route' => route('edit-layanan', request()->route()->originalParameters()),
                    'second_label' => 'Edit Layanan',
                    'third_label'  => request()->route()->parameters()['layanan']['nama_layanan']
                ];
                break;
            case stristr ($routeName, 'daftar-satker') :
                $data = [
                    'first_route' => route('daftar-satker'),
                    'first_label' => 'Daftar Satker'
                ];
                break;
            case stristr ($routeName, 'tambah-satker') :
                $data = [
                    'first_route' => route('daftar-satker'),
                    'first_label' => 'Daftar Satker',
                    'third_label' => 'Tambah Satker'
                ];
                break;
            case stristr ($routeName, 'edit-satker') :
                $data = [
                    'first_route'  => route('daftar-satker'),
                    'first_label'  =>  'Daftar Satker',
                    'second_route' => route('edit-satker', request()->route()->originalParameters()),
                    'second_label' => 'Edit Satker',
                    'third_label'  => request()->route()->parameters()['satker']['nama']
                ];
                break;
        }

        $view->with($data);
    }
}
