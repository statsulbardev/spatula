<div>
    <a
        wire:click="logout"
        class="flex items-center space-x-2"
        x-bind:class="{'hover:text-gray-300':$store.sidebar.full}">
        @include('components.icon', ['name' => 'logout', 'size' => 'w-5 h-5'])
        <h1 class="text-sm" x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">
            Logout
        </h1>
    </a>
</div>
