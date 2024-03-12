@section('title', 'Daftar Layanan Antrian')

<div class="w-full lg:w-3/4 px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Antrian Pribadi'])
        {{-- Antrian Baru --}}
        <a href="{{ route('antrian-non-admin-item-tambah') }}" wire:navigate
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Daftar Antrian</span>
        </a>
    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')
    <section class="mb-6 mt-10">
        
        <livewire:antrian.non-admin.component.daftar-antrian-bukan-sekarang/>
    </section>
    
    {{-- Content --}}
</div>
