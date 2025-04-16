<div class="mb-6 w-full">
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if (isset($labelopt))
            <sup class="ml-1 rounded bg-green-100 p-1 text-xs text-green-700 opacity-80">{{ $labelopt }}</sup>
        @endif
    </label>
    <input
        wire:model.{{ $method ?? null}}="{{ $model }}"
        id="{{ $model }}"
        ref="input"
        class="form-input"
        type="{{ $type }}"
        @if (isset($option)) disabled @endif
    >

    <x-forms.attributes.error :model="$model" />
</div>
