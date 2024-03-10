@section('title', 'Login Antrian')

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
            <div class="bg-glass flex flex-col items-center justify-between px-10 py-4">
                <button type="submit" class="btn-secondary w-full">LOG IN</button>
                <a type="submit" href="{{route('antrian-non-admin-auth-registrasi')}}"
                    class="mt-2 w-full text-center whitespace-nowrap rounded bg-fuchsia-400 px-6 py-3 text-sm font-bold text-fuchsia-900 
                        hover:bg-secondary-500 focus:bg-secondary-500">
                    REGISTRASI
                </a>
            </div>
        </form>
    </div>
</div>
