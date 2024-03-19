@section('title', 'Konfigurasi Antrian')

<div class="px-4 md:px-6 2xl:px-11 py-8">

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
                    <h1 class="text-xl lg:text-2xl tracking-wide">Tanggal Antrian Tidak Aktif </h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                       Masukkan daftar tanggal (format YYYY-MM-DD) antrian dimatikan (hari sabtu dan minggu otomatis mati).
                    </p>
                    <p class="leading-6 lg:pr-24 text-md lg:text-base text-justify">
                       Contoh : 2024-01-01, 2024-01-02, 2024-01-31
                    </p>
                </div>
                <div wire:key="{{ rand() }}" class="w-full mt-3">
                    <form wire:submit="submit_data_perubahan('tanggal_disabled', Object.fromEntries(new FormData($event.target)))">
                        <textarea name="tanggal_disabled" rows="4" cols="50" class="form-input border-neutral-300 py-1">{{$data_tanggal_disabled}}</textarea>
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
        <hr>
        <div class="w-full overflow-x-auto rounded bg-white shadow pb-2">
            <div class="flex flex-wrap p-6">
                <div class="w-full">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Playlist Video/Audio </h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                       Masukkan Link video/Audio youtube.
                    </p>
                </div>
                <div wire:key="{{ rand() }}" class="w-full mt-3" x-data='{ data_playlist : @json($data_playlist), playlist_type_value: "{!! $data_playlist_type !!}" }'>
                    <form wire:submit="submit_data_perubahan('video', Object.fromEntries(new FormData($event.target)))">
                        <select class="form-input border-neutral-300 py-1" x-model="playlist_type_value" >
                            <option value="video_and_audio">Video Tampil dan Audio Bunyi</option>
                            <option value="video_and_no_audio">Video Tampil dan Audio Tidak Bunyi</option>
                            <option value="no_video_and_audio">Video Tidak Tampil dan Audio Bunyi</option>
                            <option value="no_video_and_no_audio">Video Tidak Tampil dan Audio Tidak Bunyi</option>
                        </select>
                        <input name="playlist_type" class="invisible" type="text" x-model="playlist_type_value">
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
                <div wire:key="{{ rand() }}"  class="w-full mt-3">
                    <form wire:submit="submit_data_perubahan('footer', Object.fromEntries(new FormData($event.target)))" 
                        x-data='{ footer_type_value: "{!! $data_footer_type !!}" }'>
                        <select class="form-input border-neutral-300 py-1" x-model="footer_type_value">
                            <option value="with_footer">Tampilkan Footer</option>
                            <option value="without_footer">Sembunyikan Footer</option>
                        </select>
                        <input name="footer_type" class="invisible" type="text" x-model="footer_type_value">
                        <div>
                            <input id="note_id_1" name="footer" class="form-input border-neutral-300 py-1 mt-3" type="hidden" value="{!! $data_footer !!}">
                            <div class="py-1 mt-3">
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
