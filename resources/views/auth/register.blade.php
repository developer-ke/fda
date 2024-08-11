@extends('layouts.auth')

@section('content')
    <div class="container ">
        <div class="row mx-auto d-flex align-items-center vh-100 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-none">
                    <div class="card-header fda-bg text-center">
                        <img src="{{ asset('logo.png') }}" class="mx-auto" alt="">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="name"
                                        class="form-check-label text-capitalize">{{ __('Full Name') }}</label>
                                    <div class="input-group input-group-outline">
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" required autocomplete="name"
                                            placeholder="your name here..." autofocus>
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="email"
                                        class="form-check-label text-capitalize">{{ __('Email Address') }}</label>
                                    <div class="input-group input-group-outline">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required placeholder="your email here..."
                                            autocomplete="email">
                                    </div>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password"
                                        class="form-check-label text-capitlize">{{ __('Password') }}</label>

                                    <div class="input-group input-group-outline">
                                        <input id="password" type="password" class="form-control" name="password" required
                                            autocomplete="new-password" placeholder="type here...">
                                    </div>
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password-confirm"
                                        class="form-check-label text-capitalize">{{ __('Confirm Password') }}</label>
                                    <div class="input-group input-group-outline">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="same pasword here...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn w-100 fda-bg mt-2 text-white">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer mt-0">
                        <div class="text-center mb-3">
                            <span class="form-check-label text-center">- - - - - - - - Or Register With- - - - - - - -
                            </span>
                        </div>
                        <div class="row mx-auto justify-content-between">
                            <div class="col-auto">
                                <a href="{{ route('auth.redirect', ['provider' => 'google']) }}" data-bs-toggle='tooltip'
                                    title="Google">
                                    <span class="avatar bg-danger">
                                        <span class="bi bi-google"></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('auth.redirect', ['provider' => 'facebook']) }}" data-bs-toggle='tooltip'
                                    title="Facebook">
                                    <span class="avatar bg-info">
                                        <span class="bi bi-facebook"></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('auth.redirect', ['provider' => 'twitter']) }}" data-bs-toggle='tooltip'
                                    title="Twitter">
                                    <span class="avatar bg-dark">
                                        <span class="bi bi-twitter"></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('auth.redirect', ['provider' => 'github']) }}" data-bs-toggle='tooltip'
                                    title="Github">
                                    <span class="avatar bg-secondary">
                                        <span class="bi bi-github"></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="text-center">
                                <p class="form-check-label">
                                    Already have an account?
                                    <a href="{{ route('login') }}">
                                        <b class="fda-color">Login.</b>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
