@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName))])

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            @if ($routeName === 'tambah-layanan')
            <form wire:submit.prevent="storeNewService">
            @else
            <form wire:submit.prevent="updateService">
            @endif
                <div class="p-6 flex flex-wrap">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Jenis Layanan</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Informasi jenis layanan terdiri dari kode layanan dan nama layanan
                            yang dapat ditambah atau dimodifikasi.
                        </p>
                    </div>
                    <div class="pr-3 lg:w-2/3">
                        <div class="my-6 w-full">
                            @include('components.input.text', [
                                'model' => 'kode_layanan',
                                'label' => 'Kode Layanan',
                                'type'  => 'text'
                            ])
                        </div>
                        <div class="my-6 w-full">
                            @include('components.input.text', [
                                'model' => 'nama_layanan',
                                'label' => 'Nama Layanan',
                                'type'  => 'text'
                            ])
                        </div>
                        <div class="my-6 w-full">
                            @include('components.input.text', [
                                'model' => 'deskripsi',
                                'label' => 'Deskripsi Layanan',
                                'type'  => 'text'
                            ])
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-layanan' ? 'Simpan' : 'Perbaharui'}}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
