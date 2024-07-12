<div class="container-fluid mb-3">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            <strong>Success!</strong>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            <strong>Error!</strong>
            {{ session('error') }}
        </div>
    @endif
    @if (session('complete_profile'))
        <div class="alert alert-info alert-dismissible fade show text-white " role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong class="me-1">Please!</strong>
            {{ session('complete_profile') }}
            <a href="{{ route('profile.complete') }}">
                Here
                <span class="fa fa-arrow-circle-right"></span>
            </a>
        </div>
    @endif
</div>
