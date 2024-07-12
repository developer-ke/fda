@php
    $note = 'lost document';
@endphp
@extends('layouts.subscriber')
@section('content')
    <div class="card shadow-none mt-2">
        <div class="card-header">
            <span>
                <a href="{{ route('subscriber.lostDocuments') }}">
                    <i class="bi bi-arrow-left-circle me-1"></i>
                    Back
                </a>
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('subscriber.lostDocuments.update', ['document_id' => $document->id]) }}"
                class="form-header" id="lreport-form" method="post"accept-charset="utf-8">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-4 mb-3">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">type of document</label>
                            <div class="input-group input-group-outline">
                                <select name="document_type_id" id="ldocumentType" class='form-control' required>
                                    <option value="" selected="selected" disabled>Select document Type
                                    </option>
                                    @foreach ($types as $document_type)
                                        <option value="{{ $document_type->id }}"
                                            @if ($document->document_type_id === $document_type->id) selected @endif>
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
                                    placeholder="Enter Document/Serial No"
                                    value="{{ old('document_serial_number') ?? $document->serialNumber }}" required>
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
                                    value="{{ old('institution_on_doc') ?? $document->institution_on_document }}">
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
                                        <option value="{{ $country->id }}"
                                            @if ($document->country_id === $country->id) selected @endif>{{ $country->name }}
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
                                    placeholder="Location you Lost it"
                                    value="{{ old('locationLost') ?? $document->location }}" required>
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
                                    placeholder="Police report ref no."
                                    value="{{ old('police_refNo') ?? $document->police_ref_number }}">
                            </div>
                            @error('police_refNo')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">owner's first name</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="fname" id="lownerfirstname" type="text"
                                    placeholder="Your first name" value="{{ old('fname') ?? $document->firstName }}"
                                    required>
                            </div>
                            @error('fname')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">owner's last name</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="lname" id="lownerlastname" type="text"
                                    placeholder="Your last name" value="{{ old('lname') ?? $document->lastName }}"
                                    required>
                            </div>
                            @error('lname')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">owner's email address</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="email_address" id="femailaddress" type="email"
                                    placeholder="Your email" value="{{ old('email_address') ?? $document->email }}"
                                    required>
                            </div>
                            @error('email_address')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">owner's country code</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="lcountrycode" id="fcountrycode" type="text"
                                    placeholder="Code" value="{{ old('lcountrycode') ?? $document->code }}" required>
                            </div>
                            @error('lcountrycode')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">owner's phone number</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="lphone_number" id="fphonenumber" type="text"
                                    placeholder="Phone number"
                                    value="{{ old('lphone_number') ?? $document->phoneNumber }}" required>
                            </div>
                            @error('lphone_number')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="container-fluid">
                            <label class="form-check-label text-capitalize">owner's phone number</label>
                            <div class="input-group input-group-outline">
                                <input class="form-control " name="return_address" id="ReturnAddress" type="text"
                                    placeholder="Post and physical address"
                                    value="{{ old('return_address') ?? $document->address }}" required>
                            </div>
                            @error('return_address')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" id="lbtn" class="btn fda-bg w-100 text-white">update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
