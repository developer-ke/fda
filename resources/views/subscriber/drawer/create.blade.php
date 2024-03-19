@php
    $note = 'add drawer';
@endphp
@extends('layouts.subscriber')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <span>
                        <a href="{{ route('subscriber.drawer') }}">
                            <span class="fa fa-arrow-circle-left"></span>
                            Back
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <p class="card-title mb-3">All the marked fields are required <b class="fda-color">*</b></p>
                    <form action="{{ route('subscriber.drawer.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6  col-lg-4 mb-3">
                                <label for="" class="form-check-label text-capitalize">first name <b
                                        class="fda-color">*</b></label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="firstName" placeholder="first name" class="form-control"
                                        value="{{ old('firstName') }}" autofocus required>
                                </div>
                                @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">second name</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="secondName" placeholder="middle name" class="form-control"
                                        value="{{ old('secondName') }}" required>
                                </div>
                                @error('secondName')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">last name <b class="fda-color">*</b></label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="lastName" class="form-control" placeholder="last name"
                                        value="{{ old('lastName') }}" required>
                                </div>
                                @error('lastName')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">serial number <b
                                        class="fda-color">*</b></label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="serialNumber" class="form-control" placeholder="12345678889"
                                        value="{{ old('serialNumber') }}" required>
                                </div>
                                @error('serialNumber')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">date of expiry</label>
                                <div class="input-group input-group-outline">
                                    <input type="date" name="expiryDate" class="form-control"
                                        value="{{ old('expiryDate') }}" required>
                                </div>
                                @error('expiryDate')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">type of document <b
                                        class="fda-color">*</b></label>
                                <div class="input-group input-group-outline">
                                    <select name="documentType" id="country" class="form-control">
                                        <option value="" disabled selected>select document type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('institution')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label class="form-check-label text-capitalize">institution <b
                                        class="fda-color">*</b></label>
                                <div class="input-group input-group-outline">
                                    <select name="institution" id="country" class="form-control">
                                        <option value="" disabled selected>select the institution</option>
                                        @foreach ($institutions as $institution)
                                            <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('institution')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-8 mt-2">
                                <button class="btn fda-bg text-white w-100 mt-4 mb-0">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
