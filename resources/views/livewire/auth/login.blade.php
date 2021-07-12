@section('title', 'Login')

<div>
    <form wire:submit.prevent="login" class="form-validate">
        {{-- <hr class="mb-5 mt-5 divider"> --}}
        <div class="form-group">
            <input wire:model.defer="username" id="username" type="text" class="input-material">
            <label for="username" class="label-material">Username</label>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input wire:model.defer="password" id="password" type="password" class="input-material">
            <label for="password" class="label-material">Password</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>

        @error('error')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </form>
</div>

@push('scripts')
<script src="{{ secure_asset(env('APP_URL') . '/js/front.js') }}"></script>
@endpush
