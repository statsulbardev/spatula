<div {{ $attributes->merge(['class' => 'group relative flex place-items-center gap-3']) }}
    @click.prevent="selected = (selected === '{{ $page }}' ? '':'{{ $page }}')">
    <x-icons.heroline name="{{ $icon }}" size="h-5 w-5" />
    <span class="text-sm font-medium tracking-wider w-1/2">{{ $label }}</span>
    <x-icons.heroline name="chevron-down" size="h-4 w-4" />
</div>
