@php
    $note = 'new institution';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <span>
                        <a href="{{ route('admin.institutions') }}">
                            <span class="fa fa-arrow-circle-left"></span>
                            Back
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.institutions.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution's name</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="kenya revenue authority" value="{{ old('name') }}" autofocus
                                        required>
                                </div>
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">country on</label>
                                <div class="input-group input-group-outline">
                                    <select name="country" id="country" class="form-control">
                                        <option value="" disabled selected>select the country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('country')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution phone number</label>
                                <div class="input-group input-group-outline">
                                    <input type="number" name="phoneNumber" class="form-control" placeholder="0712345678"
                                        value="{{ old('phoneNumber') }}" required>
                                </div>
                                @error('phoneNumber')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution alternative phone number</label>
                                <div class="input-group input-group-outline">
                                    <input type="number" name="altPhoneNumber" class="form-control"
                                        placeholder="0712345678" value="{{ old('altPhoneNumber') }}">
                                </div>
                                @error('altPhoneNumber')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution's email address</label>
                                <div class="input-group input-group-outline">
                                    <input type="email" name="email" class="form-control" placeholder="kra@gmail.co.ke"
                                        value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution's address</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="address" class="form-control" placeholder="p.o.box 1260"
                                        value="{{ old('address') }}" required>
                                </div>
                                @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution's town</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="location" class="form-control" placeholder="nyahururu"
                                        value="{{ old('location') }}" required>
                                </div>
                                @error('location')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">assign correspondent</label>
                                <div class="input-group input-group-outline">
                                    <select name="correspondent" class="form-control">
                                        <option selected disabled>
                                            @if ($users->count() === 0)
                                                no users with required role
                                            @else
                                                select the correspondent
                                            @endif
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('correspondent')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">latitude</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="latitude" class="form-control"
                                        value="{{ old('latitude') }}" placeholder="eg 3.6678">
                                </div>
                                @error('latitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">longitude</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="longitude" class="form-control"
                                        value="{{ old('longitude') }}" placeholder="eg 3.6678">
                                </div>
                            </div>
                            @error('longitude')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col-12 col-md-8 col-lg-8 mb-3">
                                <label class="form-check-label text-capitalize">institution's logo</label>
                                <div class="input-group input-group-outline">
                                    <input type="file" onchange="showImage(this)" name="image" class="form-control"
                                        value="{{ old('image') }}">
                                </div>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="card h-100 shadow-none border-1">
                                            <div class="card-header">
                                                <p class="card-text">logo preview</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="container">
                                                    <img src="" class="img-fluid rounded-top mb-3" alt=""
                                                        id="preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 ">
                                {!! htmlFormSnippet() !!}
                                <br>
                                @error('g-recaptcha-response')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn fda-bg text-white w-100 mt-4 mb-0">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
