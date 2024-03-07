@section('title', 'Daftar Layanan Antrian')

<div class="w-full lg:w-3/4 px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Antrian Pribadi'])

    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow pb-2">
            @livewire('antrian.non-admin.component.daftar-antrian-sekarang')
            @livewire('antrian.non-admin.component.daftar-antrian-bukan-sekarang')
        </div>
    </section>
    
    {{-- Content --}}
</div>
