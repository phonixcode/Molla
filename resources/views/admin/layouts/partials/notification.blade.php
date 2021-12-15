@if (session('success'))
<div class="alert border-0 alert-success m-b-30 alert-dismissible fade show border-radius-none" id="alert" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="ti ti-close"></i>
    </button>
</div>
@elseif (session('error'))
<div class="alert border-0 alert-danger m-b-30 alert-dismissible fade show border-radius-none" id="alert" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="ti ti-close"></i>
    </button>
</div>
@endif
