@extends('layouts.auth')
@section('content')
    <div class="row d-flex align-items-center vh-100  justify-content-center">
        <div class="col-12">
            <div class="card text-start">
                <div class="card-header mt-n4 fda-bg shadow mx-3 rounded-3 py-5">
                    <h4 class="text-md text-uppercase text-white">
                        <i class="fa fa-check-circle"></i>
                        Complete your profile
                    </h4>
                </div>
                <div class="card-body">
                    <p class="card-text">All marked field are required <b class="text-danger">*</b></p>
                    <form action="{{ route('profile.complete.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">phone number <b
                                        class="text-danger">*</b></label>
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" autofocus name="phoneNumber"
                                        placeholder="0712345678" value="{{ old('phoneNumber') }}">
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
                                        placeholder="0712345678" value="{{ old('altPhoneNumber') }}">
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
                                            <option value="{{ $country->id }}" class="text-capitalize">{{ $country->name }}
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
                                        <option value="" disabled selected>select your gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
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
                                        value="{{ old('dob') }}">
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
                                        value="{{ old('organization') }}" placeholder="Bank or school">
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
                                        value="{{ old('address') }}" placeholder="Ngahururu">
                                </div>
                                @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-8 mt-2">
                                <button class="btn fda-bg w-100 text-white mt-4">
                                    submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
