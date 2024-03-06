@section('title', 'Login Antrian')

<div class="overflow-hidden rounded-lg">
    <div class="w-full max-w-md">
        <form wire:submit="submit_auth">
            <div class="px-10 pt-10">
                <div class="mb-8" x-data="{ type: 0 }">
                    <div>
                        <!-- <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="type">Type</label> -->
                        <select x-model="type" wire:model="type" ref="input" class="form-input" autofocus>
                            <option value="0" selected>Sudah Pernah Daftar (Login)</option>
                            <option value="1">Belum Pernah Daftar (Registrasi)</option>
                        </select>
                        @error('type')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_email">Email</label>
                        <input wire:model="konsumen_email" ref="input" class="form-input" type="email" autofocus autocapitalize="off" required>
                        @error('konsumen_email')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_no_wa_telepon">Nomor Telpon dan WA </label>
                        <input wire:model="konsumen_no_wa_telepon" ref="input" class="form-input" type="number" autofocus required>
                        @error('konsumen_no_wa_telepon')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_tahun_lahir">Tahun Lahir </label>
                        <input wire:model="konsumen_tahun_lahir" ref="input" class="form-input" type="number" autofocus required>
                        @error('konsumen_tahun_lahir')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                    <div class="mt-6"  x-show="type == 1" x-cloak>
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="konsumen_nama">Nama </label>
                        <input wire:model="konsumen_nama" ref="input" class="form-input" type="text" autofocus required>
                        @error('konsumen_nama')
                            @include('components.notification.error_white')
                        @enderror
                    </div>
                </div>
                @if ($error_login_text != '')
                    <div class="mt-4 mb-2">
                        <span class="flex items-center text-sm text-white">
                            @include('components.icon', ['name' => 'information-circle', 'size' => 'w-5 h-5'])
                            <span class="ml-2">{{ $error_login_text }}</span>
                        </span>
                    </div>
                @endif
            </div>
            <div class="bg-glass flex items-center justify-between px-10 py-4">
                <button type="submit" class="btn-secondary w-full">LOG IN</button>
            </div>
        </form>
    </div>
</div>
