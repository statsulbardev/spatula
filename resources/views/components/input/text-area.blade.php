<label class="form-label font-bold" for="{{ $label }}">
    {{ $label }}
    @if(isset($label_opt))
        <sup class="rounded-lg bg-neutral-100 ml-1 p-1 text-xs text-gray-700">{{ $label_opt }}</sup>
    @endif
</label>
<div class="overflow-y" wire:ignore x-data @trix-blur="$dispatch('change', $event.target.value)">
    <trix-editor wire:model.defer="{{ $model }}" class="form-textarea"></trix-editor>
</div>
