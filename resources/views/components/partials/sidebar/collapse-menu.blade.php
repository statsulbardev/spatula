<div class="cursor-pointer">
    {{-- Label --}}
    <x-partials.sidebar.label-menu class="{{ $class }}" :page="$page" :icon="$icon" :label="$label" />

    {{-- Submenu --}}
    <div class="flex flex-row" :class="(selected === '{{ $page }}') ? 'mt-2' : ''">
        <span {{ $attributes->merge(['class' => 'border-1 border-l border-gray-900 dark:border-white ml-2 ' .
            $verticalborder]) }}></span>
        <ul class="flex flex-col gap-1" :class="(selected === '{{ $page }}') ? 'block' : 'hidden'">
            {{ $slot }}
        </ul>
    </div>
</div>

