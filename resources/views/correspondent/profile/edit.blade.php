@php
    $note = 'edit profile';
@endphp
@extends('layouts.correspondent')
@section('content')
    <div class="row mx-auto mt-5">
        <div class="col-12">
            <div class="card text-start">
                <div class="card-header mt-n4 fda-bg shadow mx-3 rounded-3 py-5">
                    <h4 class="text-md text-uppercase text-white">
                        <i class="fa fa-check-circle"></i>
                        update your profile
                    </h4>
                </div>
                <div class="card-body">
                    <p class="card-text">All marked field are required <b class="text-danger">*</b></p>
                    <form action="{{ route('correspondent.profile.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="name" class="form-check-label text-capitalize">{{ __('Full Name') }}</label>
                                <div class="input-group input-group-outline">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') ?? $user->name }}" required autocomplete="name"
                                        placeholder="your name here..." autofocus>
                                </div>
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="email"
                                    class="form-check-label text-capitalize">{{ __('Email Address') }}</label>
                                <div class="input-group input-group-outline">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') ?? $user->email }}" required placeholder="your email here..."
                                        autocomplete="email">
                                </div>
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">phone number <b
                                        class="text-danger">*</b></label>
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" autofocus name="phoneNumber"
                                        placeholder="0712345678" value="{{ old('phoneNumber') ?? $user->phoneNumber }}">
                                </div>
                                @error('phoneNumber')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">aleternative phone number</label>
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" autofocus name="altPhoneNumber"
                                        placeholder="0712345678"
                                        value="{{ old('altPhoneNumber') ?? $user->altPhoneNumber }}">
                                </div>
                                @error('altPhoneNumber')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">country <b class="text-danger">*</b></label>
                                <div class="input-group input-group-outline">
                                    <select name="country" id="" class='form-control'>
                                        <option value="" disabled selected>select your counntry</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" class="text-capitalize"
                                                @if ($user->countryName === $country->name) selected @endif>{{ $country->name }}
                                            </option>
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
                                <label class="form-check-label text-capitalize">gender <b class="text-danger">*</b></label>
                                <div class="input-group input-group-outline">
                                    <select name="gender" id="" class='form-control'>
                                        <option value="male" @if ($user->gander === 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($user->gander === 'female') selected @endif>Female
                                        </option>
                                        <option value="others" @if ($user->gander === 'others') selected @endif>Others
                                        </option>
                                    </select>
                                </div>
                                @error('gender')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">date of birth(DOB) <b
                                        class="text-danger">*</b></label>
                                <div class="input-group input-group-outline">
                                    <input type="date" name="dob" class="form-control" autofocus
                                        value="{{ old('dob') ?? $user->dateOfBirth }}">
                                </div>
                                @error('dob')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">Organization/institution <b
                                        class="text-danger">*</b>
                                </label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="organization" class="form-control" autofocus
                                        value="{{ old('organization') ?? $user->organization }}"
                                        placeholder="Bank or school">
                                </div>
                                @error('organization')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">physical address/location <b
                                        class="text-danger">*</b>
                                </label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="address" class="form-control" autofocus
                                        value="{{ old('address') ?? $user->physicalAddress }}" placeholder="Ngahururu">
                                </div>
                                @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12  mt-2">
                                <button class="btn fda-bg w-100 text-white mt-4">
                                    update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
