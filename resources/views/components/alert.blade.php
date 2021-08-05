@if (session()->get('msg'))

    <div class="mt-3 alert alert-{{ session()->get('error') ?? 'warning' }} alert-dismissible fade show" role="alert">
        {{ session()->get('msg') ?? 'sim' }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif