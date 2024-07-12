@php
    $note = 'add user';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        <div class="page-header py-6 fda-bg text-center rounded-3">
            <img src="{{ asset('logo.png') }}" alt="FoundDocument logo" class="mx-auto">
        </div>
        <div class="card mt-n4 mx-2">
            <span class="ms-2">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-arrow-circle-left"></i>
                    Back
                </a>
            </span>
            <div class="card-header">
                <h4 class="text-sm text-capitalize">new user</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-2">
                            <label for="name" class="form-check-label text-capitalize">{{ __('Full Name') }}</label>
                            <div class="input-group input-group-outline">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" placeholder="your name here..."
                                    autofocus>
                            </div>
                            @error('name')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label for="email" class="form-check-label text-capitalize">{{ __('Email Address') }}</label>
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
                        <div class="col-12">
                            <button type="submit" class="btn w-100 fda-bg text-white mt-4">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
