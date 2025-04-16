<div class="mb-6 w-full">
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if (isset($labelopt))
            <sup class="ml-1 rounded-lg bg-neutral-100 p-1 text-xs text-gray-700">{{ $label_opt }}</sup>
        @endif
    </label>
    <div wire:ignore>
        <trix-editor class="form-textarea w-full" x-data x-on:trix-change="$dispatch('input', event.target.value)"
            x-ref="trix" wire:model="{{ $model }}" wire:key="{{ Str::random() }}">
        </trix-editor>
    </div>

    <x-forms.attributes.error :model="$model" />
</div>
