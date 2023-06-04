<div wire:ignore>
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if (isset($label_opt))
            <sup class="rounded bg-green-100 opacity-80 ml-1 p-1 text-xs text-green-700">{{ $label_opt }}</sup>
        @endif
    </label>
    <select id="{{ $id }}" wire:model.defer="{{ $model }}" data-te-select-init
        data-te-select-filter="true" @isset($prop) {{ $prop }} @endisset>
        <option hidden selected>{{ $opt_title }}</option>
        {!! $opt_item !!}
    </select>
</div>

@push('scripts')
    <script>
        te.Select.getInstance(document.querySelector("#{{ $id }}")).setValue("{{ $value }}");
    </script>
@endpush
