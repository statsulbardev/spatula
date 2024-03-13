<div wire:ignore 
    x-init="() => { 
        window.te.Datepicker.getOrCreateInstance(document.querySelector('#{{ $id }}')).setValue('{{ $value }}');
    }">
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
    </label>
    <input
        type="text" id="{{ $id }}" wire:model="{{ $model }}"
        placeholder="{{ $label }}"/>

</div>