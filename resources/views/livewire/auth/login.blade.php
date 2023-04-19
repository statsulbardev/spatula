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
                    </div>
                    <div class="mt-6">
                        <label class="form-label" for="password">Password</label>
                        <input wire:model="password" ref="input" class="form-input" type="password">
                    </div>
                </div>
                @if($errors->has('message'))
                <div class="mt-6 rounded bg-supportred-400 p-2 text-white text-sm leading-4 text-center">
                    {{ $errors->first('message') }}
                </div>
                @endif
            </div>
            <div class="px-10 py-4 bg-glass flex justify-between items-center">
                <button class="btn-secondary w-full" type="submit">Masuk</button>
            </div>
        </form>
    </div>
</div>
