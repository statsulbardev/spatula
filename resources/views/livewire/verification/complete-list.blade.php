@section('title', 'Selesai Tindak Lanjut')

<div>
    <div class="mb-8">
        @include('components.page.page-title', ['title' => 'Selesai Tindak Lanjut'])
    </div>

    @livewire('component.complete-list-table')
</div>
