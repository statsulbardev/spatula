<div>
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if (isset($label_opt))
            <sup class="ml-1 rounded bg-green-100 p-1 text-xs text-green-700 opacity-80">{{ $label_opt }}</sup>
        @endif
    </label>
    <select
        id="{{ $id }}"
        class="form-select"
        wire:model.live="{{ $model }}"
        @isset($prop) {{ $prop }} @endisset>
        <option hidden selected>{{ $opt_title }}</option>
        {!! $opt_item !!}
    </select>
</div>
