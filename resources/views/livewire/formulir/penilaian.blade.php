@extends('layouts.base')

@section('title', 'Form Penilaian Layanan')

@section('content')
<section>
    <div class="container mx-auto">
        <div class="bg-white border-r border-t border-l border-gray-200 shadow-sm rounded-t-lg mt-4 py-4">
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Informasi Penerima Layanan</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Silahkan isi dengan jelas dan lengkap data diri anda sebagai penerima layanan
                        statistik terpadu.
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        @include('components.input.text', [
                            'model' => 'f_nama',
                            'label' => 'Nama Lengkap',
                            'type'  => 'text'
                        ])
                    </div>
                    <div class="my-6 w-full">
                        @include('components.input.text', [
                            'model' => 'f_email',
                            'label' => 'Akun Email',
                            'type'  => 'email'
                        ])
                    </div>
                    <div class="my-6 w-full">
                        @include('components.input.text', [
                            'model' => 'f_notelpwhatsapp',
                            'label' => 'No. Telepon / Whatsapp',
                            'type'  => 'text'
                        ])
                    </div>
                </div>
            </div>
            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Penilaian Layanan</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Bagaimana penilaian anda terhadap layanan yang diberikan oleh
                        <b class="text-primary-500 font-bold">BPS Provinsi Sulawesi Barat</b> ?
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        @include('components.input.select', [
                            'model'     => 'f_layanan',
                            'label'     => 'Nama Layanan',
                            'opt_title' => 'Pilih Jenis Layanan ...',
                            'opt_item'  => $services
                        ])
                    </div>
                    <div class="my-6">
                        <div
                            x-data="
                            {
                                rating: 0,
                                hoverRating: 0,
                                ratings: [{'amount': 1, 'label':'Sangat Tidak Puas'}, {'amount': 2, 'label':'Tidak Puas'}, {'amount': 3, 'label':'Biasa Saja'}, {'amount': 4, 'label':'Puas'}, {'amount': 5, 'label':'Sangat Puas'}],
                                rate(amount) {
                                    if (this.rating == amount) { this.rating = 0; } else this.rating = amount;
                                },
                                currentLabel() {
                                    let r = this.rating;
                                    if (this.hoverRating != this.rating) r = this.hoverRating;
                                    let i = this.ratings.findIndex(e => e.amount == r);
                                    if (i >=0) { return this.ratings[i].label; } else { return '' };
                                }
                            }"
                        >
                            <div class="flex space-x-0">
                                <template x-for="(star, index) in ratings" :key="index">
                                    <button
                                        @click="rate(star.amount)"
                                        @mouseover="hoverRating = star.amount"
                                        @mouseleave="hoverRating = rating"
                                        aria-hidden="true"
                                        :title="star.label"
                                        class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline w-12 m-0 cursor-pointer"
                                        :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                                        <svg class="w-10 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <div class="p-2">
                                <template x-if="rating || hoverRating">
                                    <p x-text="currentLabel()"></p>
                                </template>
                                <template x-if="!rating && !hoverRating">
                                    <p>Silahkan Memberi Rating !</p>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Penilaian Petugas</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Bagaimana penilaian anda terhadap petugas layanan di Pelayanan Statistik Terpadu
                        <b class="text-primary-500 font-bold">BPS Provinsi Sulawesi Barat</b> ?
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        @include('components.input.select', [
                            'model'     => 'f_petugas',
                            'label'     => 'Nama Petugas',
                            'opt_title' => 'Pilih Petugas Layanan ...',
                            'opt_item'  => $officers
                        ])
                    </div>
                </div>
            </div>
            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Kotak Saran Pengaduan</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Berikan saran / pengaduan / kritik / apresiasi untuk layanan di
                        <b class="text-primary-500 font-bold">BPS Provinsi Sulawesi Barat</b> ?
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        @include('components.input.select', [
                            'model'     => 'f_saranpengaduan',
                            'label'     => 'Saran Pengaduan',
                            'opt_title' => 'Pilih Petugas Layanan ...',
                            'opt_item'  => $officers
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-auto bg-gray-200 border-gray-200 rounded-b-lg shadow-sm p-4 text-center">
            <span class="text-sm font-light">Copyright &copy; {{ date('Y') }} - BPS Provinsi Sulawesi Barat</span>
        </div>
    </div>
</section>
@overwrite
