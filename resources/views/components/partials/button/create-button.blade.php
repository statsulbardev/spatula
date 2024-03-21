<a
    wire:navigate
    href="{{ $route }}"
    {{ $attributes->merge(['class' => 'flex items-center rounded-md bg-primary-400 p-1 text-white hover:bg-primary-500 lg:p-3']) }}>
    <x-icons.heroline name="plus-circle" size="h-5 w-5" />
    <span class="ml-1 text-xs md:ml-2 md:text-sm">{{ $title }}</span>
</a>
