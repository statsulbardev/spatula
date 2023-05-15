@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName)) . ' ' . $satker->nama])

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <form wire:submit.prevent="storeData">
                <div class="p-6 flex flex-wrap">
                    <div class="lg:w-1/3 sm:w-full">
                        <h1 class="text-2xl tracking-wide">Informasi Satker</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Informasi satker terdiri dari kode satker, nama, alamat, website, dan telepon
                            yang dapat diisi atau diubah.
                        </p>
                    </div>
                    <div class="lg:w-2/3 sm:w-full">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
