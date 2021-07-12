@section('styles')
<style>
    a { cursor: pointer }
</style>
@endsection

<div>
    <a wire:click="logout">
        <span class="d-none d-sm-inline">Logout</span>
        <i class="fa fa-sign-out"></i>
    </a>
</div>
