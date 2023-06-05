<div class="flex-no-wrap flex items-center rounded border focus-within:shadow-outline">
    <div class="ml-2 text-zinc-400">
        @include('components.icon', ['name' => 'search', 'size' => 'w-5 h-5'])
    </div>
    <input wire:model="searchKeyword"
           class="w-full px-3 text-sm"
           type="text"
           placeholder="Pencarian ..." />
</div>
