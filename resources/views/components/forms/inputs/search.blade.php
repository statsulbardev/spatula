<div class="flex-no-wrap flex items-center rounded border focus-within:shadow-outline">
    <div class="ml-2 text-zinc-400">
        <x-icons.hero name="magnifying-glass-circle-outline" size="w-5 h-5" />
    </div>
    <input wire:model.live="searchKeyword" class="w-full px-3 text-sm" type="text" placeholder="Cari Informasi ..." />
</div>
