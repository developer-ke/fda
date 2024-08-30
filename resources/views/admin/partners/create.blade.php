@php
    $note = 'New partner';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-5">
        <div class="card">
            <div class="mt-n5 py-6 fda-bg rounded-3 d-flex align-items-center mx-3">
                <a href="{{ route('admin.partner') }}" class="mt-n8 ps-2 position-absolute">
                    <span class="bi bi-arrow-left-circle text-white">Back</span>
                </a>
                <img src="{{ asset('logo.png') }}" class="mx-auto" alt="image">
            </div>
            <div class="card-body">

                <div class="row mx-auto">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-none border-1 h-100">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Partner's Logo
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.partner.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group input-group-outline">
                                                <input type="file" id="logo" name="logo" class="form-control"
                                                    onchange="PreviewLogo(this)">
                                            </div>
                                        </div>
                                        @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="col-12 mt-4">
                                            <input type="submit" class="btn fda-bg text-white w-100">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card shadow-none border-1 h-100">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Logo preview
                                </h5>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <img id="preview" alt="" class="mx-auto" height="200px" width="200px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const PreviewLogo = (input) => {
                const preview = document.getElementById("preview");
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            };
        </script>
    @endpush
@endsection
