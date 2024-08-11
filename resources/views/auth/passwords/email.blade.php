@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row d-flex align-items-center vh-100  justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-none">
                    <div class="card-header">{{ __('Reset Password') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">&times;</button>
                                <strong>Success!</strong>
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="email" class="form-check-label text-capitalize">Your registered
                                        email</label>
                                    <div class="input-group input-group-outline">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="your email here..." autofocus>
                                    </div>
                                    @error('email')
                                        <span class="text-danger text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn fda-bg w-100 mt-4 text-white">
                                        {{ __('request Link') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
