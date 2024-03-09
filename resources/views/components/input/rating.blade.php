<div wire:ignore
    x-init="() => { 
        new StarRating('#{{ $id }}', {
            maxStars: 5,
            showText: true,
        })
    }">
    <select wire:model="{{ $model }}" id="{{ $id }}" class="star-rating" class="form-control mb-3">
        <option value="" hidden selected></option>
        <option value="1">Sangat Tidak Puas</option>
        <option value="2">Tidak Puas</option>
        <option value="3">Cukup Puas</option>
        <option value="4">Puas</option>
        <option value="5">Sangat Puas</option>
    </select>
</div>