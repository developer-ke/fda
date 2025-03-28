@extends('layouts.auth')
@section('content')
    <div class="row d-flex align-items-center vh-100  justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-none">

                <div class="card-header">
                    <span class="text-capitalize">
                        <a href="{{ route('home') }}">
                            <span class="fa fa-arrow-circle-left"></span>
                            back
                        </a>
                    </span>
                    @if (session('error'))
                        <div class="alert alert-info alert-dismissible fade show text-white " role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{ asset('uploads/profiles/' . Auth::user()->image) }}" alt="your image"
                            class="avatar avatar-xxl" id="preview">
                    </div>
                    <form action="{{ route('profile.update.picture') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="input-group text-center">
                            @error('image')
                                <span>
                                    {{ $message }}
                                </span>
                            @enderror
                            <label for="image" class="mx-auto">
                                <span class="badge bg-success p-3 px-5">
                                    choose your image
                                </span>
                            </label>
                            <input id="image" name="image" type="file" hidden accept="jpeg,jpg,webp,png"
                                onchange="showImage(this)">
                        </div>
                        <button class="btn fda-bg w-100 text-white mt-4">
                            <i class="fa fa-upload me-1"></i>
                            upload now
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
