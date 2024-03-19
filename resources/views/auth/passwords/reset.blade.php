@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-none mt-5">
                    <div class="card-header">{{ __('Reset Password') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row mb-3 d-none">
                                <div class="col-md-6 d-none">
                                    <input id="email" type="email" hidden
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="password"
                                        class="col-form-check-label text-capitalize">{{ __('set new password') }}</label>
                                    <div class="input-group input-group-outline">
                                        <input id="password" type="password" class="form-control" name="password" required
                                            autocomplete="new-password">
                                    </div>
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-check-label text-capitalize">{{ __('Confirm Password') }}</label>
                                    <div class="input-group input-group-outline">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn fda-bg w-100 text-white mt-3">
                                        {{ __('Reset Password') }}
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
