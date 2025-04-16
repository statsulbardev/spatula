<div
    wire:ignore
    x-init="() => {
        window.te.Select.getOrCreateInstance(document.querySelector('#{{ $id }}')).setValue('{{ $value }}')
    }"">
    <select
        id="{{ $id }}"
        class="form-select max-w-48"
        wire:model.live="{{ $model }}"
        data-te-select-filter="true">
        <option hidden selected>{{ $placeholder }}</option>
        {!! $optitem !!}
    </select>
</div>
