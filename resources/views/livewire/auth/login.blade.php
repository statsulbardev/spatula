@section('title', 'Login')

<div class="overflow-hidden rounded-lg">
    <div class="w-full max-w-md">
        <form wire:submit="login">
            <div class="px-10 pt-10">
                {{-- <button class="btn-primary w-full">BPS SSO (Under Maintenance)</button>
                <div class="mt-8 separator">
                    <small class="px-2 font-bold text-white">atau</small>
                </div> --}}
                <div class="mb-8">
                    <div>
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="username">USERNAME</label>
                        <input wire:model="username" ref="input" class="form-input" type="text" autofocus autocapitalize="off">
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('username')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="password">PASSWORD</label>
                        <input wire:model="password" ref="input" class="form-input" type="password">
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('password')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-glass flex items-center justify-between px-10 py-4">
                <button type="submit" class="btn-secondary w-full">LOG IN</button>
            </div>
        </form>
    </div>
</div>
