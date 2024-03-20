<a
    wire:navigate
    href="{{ $route }}"
    {{ $attributes->merge(['class' => 'flex cursor-pointer gap-2 mt-1']) }}
    @click="selected = (selected === '{{ $page }}' ? '': '{{ $page }}')">
    <span class="{{ $path }} mr-2 h-4 w-4">
        <x-icons.heroline :name="$icon" size="w-5 h-5" />
    </span>
    <span class="{{ $path }} text-sm font-medium tracking-wider">
        {{ $title }}
    </span>
</a>
