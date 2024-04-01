<div class="mb-6 w-full">
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if (isset($labelopt))
            <sup class="ml-1 rounded bg-green-100 p-1 text-xs text-green-700 opacity-80">{{ $label_opt }}</sup>
        @endif
    </label>
    <select
        wire:model.{{ $method ?? null }}="{{ $model }}"
        id="{{ $model }}"
        class="form-select"
        placeholder="{{ $placeholder }}"
        @isset($prop) {{ $prop }} @endisset>
        <option hidden selected>{{ $placeholder ?? '...' }}</option>
        {!! $optitem !!}
    </select>

    <x-forms.attributes.error :model="$model" />
</div>

