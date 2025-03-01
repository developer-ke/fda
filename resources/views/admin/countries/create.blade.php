@php
    $note = 'Add country';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <span>
                        <a href="{{ route('admin.countries') }}">
                            <span class="fa fa-arrow-circle-left"></span>
                            Back
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.countries.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">country name</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="countryName" class="form-control" placeholder="Kenya"
                                        value="{{ old('countryName') }}" autofocus required>
                                </div>
                                @error('countryName')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">nationality</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="nationality" class="form-control" placeholder="kenyan"
                                        value="{{ old('nationality') }}" required>
                                </div>
                                @error('nationality')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">country's abbreviation</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="abbreviation" class="form-control" placeholder="KE"
                                        value="{{ old('abbreviation') }}" required>
                                </div>
                                @error('abbreviation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">country code</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="code" class="form-control" placeholder="+254"
                                        value="{{ old('code') }}" required>
                                </div>
                                @error('code')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">capital city</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="city" class="form-control" placeholder="Nairobi"
                                        value="{{ old('city') }}" required>
                                </div>
                                @error('city')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                {!! htmlFormSnippet() !!}
                                <br>
                            </div>
                            @error('g-recaptcha-response')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <button class="btn fda-bg text-white w-100 mt-4 mb-0">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
