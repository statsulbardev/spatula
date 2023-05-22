<div wire:ignore>
    <label class="form-label font-bold" for="{{ $label }}">
        {{ $label }}
        @if(isset($label_opt))
            <sup class="rounded bg-green-100 opacity-80 ml-1 p-1 text-xs text-green-700">{{ $label_opt }}</sup>
        @endif
    </label>
    <select id="{{ $id }}" wire:model.defer="{{ $model }}" data-te-select-init multiple @isset($prop) {{ $prop }} @endisset>
        {!! $opt_item !!}
    </select>
</div>

@push('scripts')
<script>
    Select.getInstance(document.querySelector("#{{ $id }}")).setValue({!! $value !!});
</script>
@endpush
