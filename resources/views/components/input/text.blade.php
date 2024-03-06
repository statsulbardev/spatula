<label class="form-label font-bold" for="{{ $label }}">
    {{ $label }}
    @if (isset($label_opt))
        <sup class="ml-1 rounded bg-green-100 p-1 text-xs text-green-700 opacity-80">{{ $label_opt }}</sup>
    @endif
</label>
<input id="{{ $model }}" wire:model="{{ $model }}" ref="input" class="form-input border-neutral-300" type="{{ $type }}"
       @if (isset($option)) disabled @endif>
