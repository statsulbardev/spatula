@section('title', 'Daftar Layanan Antrian')

<div class="px-4 md:px-6 2xl:px-11 py-8">
    @include('components.notification.flash')

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Konfigurasi Antrian'])

    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow pb-2">
            <div class="flex flex-wrap p-6">
                <div class="w-full">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Playlist Video/Audio </h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                       Masukkan Link video/Audio youtube.
                    </p>
                </div>
                <div wire:key="{{ rand() }}" class="w-full mt-3" x-data='{ data_playlist : @json($data_playlist) }'>
                    <form wire:submit.prevent="submit_data_perubahan('video', Object.fromEntries(new FormData($event.target)))">
                        <select name="playlist_type" class="form-input border-neutral-300 py-1">
                            @if ($data_playlist_type == 'video_and_audio')
                                <option value="video_and_audio" selected>Video Tampil dan Audio Bunyi</option>
                            @else
                                <option value="video_and_audio">Video Tampil dan Audio Bunyi</option>
                            @endif

                            @if ($data_playlist_type == 'video_and_no_audio')
                                <option value="video_and_no_audio" selected>Video Tampil dan Audio Tidak Bunyi</option>
                            @else
                                <option value="video_and_no_audio">Video Tampil dan Audio Tidak Bunyi</option>
                            @endif

                            @if ($data_playlist_type == 'no_video_and_audio')
                                <option value="no_video_and_audio" selected>Video Tidak Tampil dan Audio Bunyi</option>
                            @else
                                <option value="no_video_and_audio">Video Tidak Tampil dan Audio Bunyi</option>
                            @endif

                            @if ($data_playlist_type == 'no_video_and_no_audio')
                                <option value="no_video_and_no_audio" selected>Video Tidak Tampil dan Audio Tidak Bunyi</option>
                            @else
                                <option value="no_video_and_no_audio">Video Tidak Tampil dan Audio Tidak Bunyi</option>
                            @endif
                        </select>
                        <table class="w-full table-auto mt-3">
                            <thead>
                                <tr class="bg-neutral-100 text-left font-bold">
                                    <th class="px-2 py-4 text-center">No</th>
                                    <th class="px-2 py-4 text-center">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(value, index) in data_playlist">
                                    <tr class="focus-within:bg-grey-lightest hover:bg-gray-200 py-10">
                                        <td class="border-t items-center text-center">
                                            <span class="py-1" x-text="index + 1"></span>
                                        </td>
                                        <td class="border-t">
                                            <input x-bind:name="'url_video_'+index" class="form-input border-neutral-300 py-1" type="url" x-model="value">
                                        </td>
                                    <tr>
                                </template>
                            <tbody>
                        </table>
                        <div class="flex mt-2">
                            <div class="flex grow"></div>
                            <div class="flex  gap-2">
                                <button x-on:click="data_playlist.push('')" type="button" 
                                    class="flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
                                        @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
                                        <span class="ml-2 text-sm">Tambah Baris</span>
                                </button>
                                <button  type="submit" 
                                    class="flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
                                        <span class="ml-2 text-sm">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="w-full overflow-x-auto rounded bg-white shadow pb-2">
            <div class="flex flex-wrap p-6">
                <div class="w-full">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Daftar Footer </h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                       Masukkan tulisan footer.
                    </p>
                </div>
                <div wire:key="{{ rand() }}"  class="w-full mt-3" x-data='{ data_footer : @json($data_footer) }'>
                    <form wire:submit.prevent="submit_data_perubahan('footer', Object.fromEntries(new FormData($event.target)))">
                        <select name="footer_type" class="form-input border-neutral-300 py-1">
                            @if ($data_footer_type == 'with_footer')
                                <option value="with_footer" selected>Tampilkan Footer</option>
                            @else
                                <option value="with_footer">Tampilkan Footer</option>
                            @endif

                            @if ($data_footer_type == 'without_footer')
                                <option value="without_footer" selected>Sembunyikan Footer</option>
                            @else
                                <option value="without_footer">Sembunyikan Footer</option>
                            @endif
                        </select>

                        <div x-data="{value_footer = data_footer}">
                            <input id="note_id_1" name="footer" class="form-input border-neutral-300 py-1 mt-3" type="hidden" x-model="value_footer">
                            <div class="py-1 mt-3" x-on:trix-change="value_footer = event.target.value">
                                <trix-editor input="note_id_1"></trix-editor>
                            </div>
                        </div>
                        
                        <div class="flex mt-2">
                            <div class="flex grow"></div>
                            <div class="flex  gap-2">
                                <button  type="submit" 
                                    class="flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
                                        <span class="ml-2 text-sm">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    @if (session()->has('messages'))
        <script>
            window.onload = function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: '{{ session('messages') }}'
                }));
            }
        </script>

        {{ session()->forget('messages') }}
    @endif
    <script>
        window.addEventListener('notification', event => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: event.detail.message
            }));
        })
    </script>
@endpush
