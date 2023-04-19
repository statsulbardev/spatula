<label class="form-label font-bold" for="{{ $label }}">
    {{ $label }}
    @if(isset($label_opt))
        <sup class="rounded bg-green-100 opacity-80 ml-1 p-1 text-xs text-green-700">{{ $label_opt }}</sup>
    @endif
</label>
<input id="{{ $model }}" wire:model.defer="{{ $model }}" ref="input" class="form-input" type="{{ $type }}" @if(isset($option)) disabled @endif>

@error('{{ $model }}')
    <div class="mt-2">
        <span class="text-sm text-red-600">{{ $message }}</span>
    </div>
@enderror
