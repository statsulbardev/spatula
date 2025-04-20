@extends('components.layouts.base')

@section('content')
<div class="flex h-screen overflow-hidden">
    <x-partials.sidebar.sidebar />

    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
        <x-partials.header />
        <main class="px-6 py-8">
            {{ $slot }}
        </main>
    </div>



</div>
@overwrite
