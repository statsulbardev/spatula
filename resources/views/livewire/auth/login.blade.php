<div class="overflow-hidden rounded-lg">
    <div class="w-full max-w-md">
        <form wire:submit="login">
            <div class="px-10 pt-10">
                <div class="mb-8">
                    <div>
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="username">USERNAME</label>
                        <input wire:model="form.username" ref="input" class="form-input" type="text" autofocus autocapitalize="off">
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('validate', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.3000ms="shown">
                            @error('form.username')
                                @include('components.notification.error_white')
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold tracking-wider text-white" for="password">PASSWORD</label>
                        <input wire:model="form.password" ref="input" class="form-input" type="password">
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('validate', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.3000ms="shown">
                            @error('form.password')
                                @include('components.notification.error_white')
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
