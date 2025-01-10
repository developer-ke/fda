@php
    $note = 'lost document';
@endphp
@extends('layouts.correspondent')
@section('content')
    <div class="card shadow-none mt-2">
        <div class="card-header">
            <span>
                <a href="{{ route('correspondent.lostDocuments') }}">
                    <i class="bi bi-arrow-left-circle me-1"></i>
                    Back
                </a>
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('report_lost_document') }}" class="form-header" id="lreport-form"
                method="post"accept-charset="utf-8">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-4 mb-3">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">type of document</label>
                            <div class="input-group input-group-outline">
                                <select name="document_type_id" id="ldocumentType" class='form-control' required>
                                    <option value="" selected="selected" disabled>Select document Type
                                    </option>
                                    @foreach ($types as $document_type)
                                        <option value="{{ $document_type->id }}">
                                            {{ $document_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('document_type_id')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">serial number</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="document_serial_number" id="lserialno" type="text"
                                    placeholder="Enter Document/Serial No" value="{{ old('document_serial_number') }}"
                                    required>
                            </div>
                            @error('document_serial_number')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">institution on document</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control institution" name="institution_on_doc" id="institution-found"
                                    type="text" placeholder="Enter institution on documen(Optional)"
                                    value="{{ old('institution_on_doc') }}">
                            </div>
                            @error('institution_on_doc')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">country on document</label>
                            <div class="input-group input-group-outline">
                                <select name="country_id" id="lcountry" class='form-control' required>
                                    <option value="" selected="selected" disabled>select the country
                                    </option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country_id')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">location lost</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="locationLost" id="llocation" type="text"
                                    placeholder="Location you Lost it" value="{{ old('locationLost') }}" required>
                            </div>
                            @error('locationLost')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">police report reference</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="police_refNo" id="policeRef" type="text"
                                    placeholder="Police report ref no." value="{{ old('police_refNo') }}">
                            </div>
                            @error('police_refNo')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="form-group form-inline">
                        @php
                            $names = explode(' ', $user->name);
                        @endphp
                        <input class="form-control " name="fname" id="lownerfirstname" type="text"
                            placeholder="Your first name" value="{{ $names[0] }}" required>
                        <input class="form-control " name="lname" id="lownerlastname" type="text"
                            placeholder="Your last name" value="{{ $names[1] }}" required>
                    </div>


                    <p>Return Address</p>
                    <p id='tp'> Provide your return address and detail below</p>
                    <div class="form-group form-inline">
                        <input class="form-control " name="email_address" id="femailaddress" type="email"
                            placeholder="Your email" value="{{ $user->email }}" required>
                        <input class="form-control " name="lcountrycode" id="fcountrycode" type="text"
                            placeholder="Code" value="{{ $user->code }}" required>
                        <input class="form-control " name="lphone_number" id="fphonenumber" type="text"
                            placeholder="Phone number" value="{{ $user->phoneNumber }}" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control " name="return_address" id="ReturnAddress" type="text"
                            placeholder="Post and physical address" value="{{ $user->physicalAddress }}" required>
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
                <div class="form-group mt-4">
                    <button type="submit" id="lbtn" class="btn fda-bg w-100 text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
