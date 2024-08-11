@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row d-flex align-items-center vh-100 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-none">
                    <div class="card-header fda-bg text-center">
                        <img src="{{ asset('logo.png') }}" class="mx-auto" alt="">
                    </div>
                    <div class="card-body mb-0">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">&times;</button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="email" class="form-check-label text-capitalize">Email address</label>
                                    <div class="input-group input-group-outline">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder='type here...'>
                                    </div>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password" class="form-check-label text-capitalize">password</label>
                                    <div class="input-group input-group-outline">
                                        <input id="password" type="password" class="form-control" name="password" required
                                            autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn text-white w-100 mt-3 fda-bg">
                                        {{ __('Login') }}
                                        <i class="material-icons opacity-10">login</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer mt-0">
                        <div class="text-center mb-3">
                            <span class="form-check-label text-center">- - - - - - - - Or Login With- - - - - - - - </span>
                        </div>
                        <div class="row mx-auto">
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
                                    Forgot password?
                                    <a href="{{ route('password.request') }}">
                                        <b class="fda-color">Reset.</b>
                                    </a>
                                    <br>
                                    Don't have an account?
                                    <a href="{{ route('register') }}">
                                        <b class="fda-color">Register.</b>
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
