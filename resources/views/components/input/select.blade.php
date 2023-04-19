<label class="form-label font-bold" for="{{ $label }}">
    {{ $label }}
    @if(isset($label_opt))
        <sup class="rounded bg-green-100 opacity-80 ml-1 p-1 text-xs text-green-700">{{ $label_opt }}</sup>
    @endif
</label>
<select wire:model.defer="{{ $model }}" ref="input" class="form-select">
    <option value="" hidden selected>{{ $opt_title }}</option>
    {!! $opt_item !!}
</select>
