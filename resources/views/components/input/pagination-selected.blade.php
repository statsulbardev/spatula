<div class="flex flex-no-wrap items-center">
    <span class="mr-3 text-sm text-zinc-400">Tampilkan</span>
    <select wire:model.lazy="numberOfPagination" ref="input" class="form-select text-sm">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="100">100</option>
    </select>
</div>
