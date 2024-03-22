@section('title', 'Registrasi Antrian')

<div class="overflow-hidden rounded-lg">
    <div class="w-full max-w-md">
        <form wire:submit="submit_auth">
            <div class="px-10 pt-10">
                <div class="mb-8" x-data="{ type: 0 }">
                    <div>
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_email">Email</label>
                        <input wire:model="konsumen_email" ref="input" class="form-input" type="email" placeholder="Email" autocapitalize="off" required>
                        @error('konsumen_email')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_no_wa_telepon">Nomor Telpon dan WA </label>
                        <input wire:model="konsumen_no_wa_telepon" ref="input" class="form-input" type="number" placeholder="No Telpon dan WA" autofocus required>
                        @error('konsumen_no_wa_telepon')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_tahun_lahir">Tahun Lahir </label>
                        <input wire:model="konsumen_tahun_lahir" ref="input" class="form-input" type="number" placeholder="Tahun Lahir" autofocus required>
                        @error('konsumen_tahun_lahir')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_nama">Nama </label>
                        <input wire:model="konsumen_nama" ref="input" class="form-input" type="text" autofocus required>
                        @error('konsumen_nama')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                </div>
            </div>
            <div class="bg-glass flex items-center justify-between px-10 py-4">
                <button type="submit" class="btn-secondary w-full">REGISTRASI</button>
            </div>
        </form>
    </div>
</div>
