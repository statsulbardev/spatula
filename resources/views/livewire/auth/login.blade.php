@section('title', 'Login')

<div class="rounded-lg overflow-hidden">
    <div class="w-full max-w-md">
        <form wire:submit.prevent="login">
            <div class="px-10 pt-10">
                <button class="btn-primary w-full">BPS Single Sign On</button>
                <div class="mt-8 separator">
                    <small class="px-2 font-bold text-white">atau</small>
                </div>
                <div class="mt-6 mb-8">
                    <div>
                        <label class="form-label" for="username">Username</label>
                        <input wire:model="username" ref="input" class="form-input" type="text" autofocus autocapitalize="off">
                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('username')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="form-label" for="password">Password</label>
                        <input wire:model="password" ref="input" class="form-input" type="password">
                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('password')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-10 py-4 bg-glass flex justify-between items-center">
                <button type="submit" class="btn-secondary w-full">Masuk</button>
            </div>
        </form>
    </div>
</div>
