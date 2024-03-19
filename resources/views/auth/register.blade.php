@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-none">
                    <div class="card-header">{{ __('Register') }}</div>
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
                                            name="password_confirmation" required autocomplete="new-password" placeholder="same pasword here...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn w-100 fda-bg">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
