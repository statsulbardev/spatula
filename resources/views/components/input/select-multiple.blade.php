<div wire:ignore
    x-init="$nextTick(() => { 
        window.te.Select.getOrCreateInstance(document.querySelector('#{{ $id }}')).setValue({!! $value !!})
    })">
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if (isset($label_opt))
            <sup class="ml-1 rounded bg-green-100 p-1 text-xs text-green-700 opacity-80">{{ $label_opt }}</sup>
        @endif
    </label>
    <select id="{{ $id }}" wire:model="{{ $model }}" multiple>
        {!! $opt_item !!}
    </select>
</div>