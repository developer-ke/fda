@php
    $note = 'found document';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="card shadow-none mt-2">
        <div class="card-header">
            <span>
                <a href="{{ route('admin.foundDocuments') }}">
                    <i class="bi bi-arrow-left-circle me-1"></i>
                    Back
                </a>
            </span>
        </div>
        <div class="card-body">
            <p>Provide the information of the document you found. All marked fields are required <b class="text-danger">*</b>
            </p>
            <form class="form-header" action="{{ route('admin.foundDocuments.update', ['document_id' => $document->id]) }}"
                class="form-header" id="freport-form" method="post" accept-charset="utf-8">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">Type of document <b
                                class="text-danger">*</b></label>
                        <div class="input-group input-group-outline">
                            <select name="document_type_id" id="fdocumentType" class='form-control' required>
                                <option value="" selected="selected" disabled>Select document Type
                                </option>
                                @foreach ($types as $document_type)
                                    <option value="{{ $document_type->id }}"
                                        @if ($document_type->id === $document->document_type_id) selected @endif>
                                        {{ $document_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('document_type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">document's serial number <b
                                class="text-danger">*</b></label>
                        <div class="input-group input-group-outline">
                            <input class="form-control " name="document_serial_number" id="fserialno" type="text"
                                placeholder="Enter Document/Serial No" required
                                value="{{ old('document_serial_number') ?? $document->serialNumber }}">
                        </div>
                        @error('document_serial_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">Institution on document</label>
                        <div class="input-group input-group-outline">
                            <input class="form-control institution" name="institution_on_doc" id="institutionFound"
                                type="text" placeholder="Enter institution on document"
                                value="{{ old('institution_on_doc') ?? $document->institution_on_document }}">
                        </div>
                        @error('institution_on_doc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">country on document <b
                                class="text-dnager">*</b></label>
                        <div class="input-group input-group-outline">
                            <select name="country_id" id="fcountry" class='form-control' required>
                                <option value="" selected="selected" disabled>Country on document
                                </option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if ($country->id === $document->country_id) selected @endif>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">latitude <b>*</b></label>
                        <div class="input-group input-group-outline">
                            <input class="form-control" name="latitude" id="latitude" type="text" placeholder="latitude"
                                required value="{{ old('latitude') ?? $document->latitude }}" readonly>
                        </div>
                        @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">Longitude <b class="text-danger">*</b></label>
                        <div class="input-group input-group-outline">
                            <input class="form-control" name="longitude" id="longitude" type="text"
                                placeholder="longituder" required value="{{ old('longitude') ?? $document->longitude }}"
                                readonly>
                        </div>
                        @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <button class="btn w-100 fda-bg text-white GeoLocationBtn">Get coordinates</button>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">owner's first name <b
                                class="text-danger">*</b></label>
                        <div class="input-group input-group-outline">
                            <input class="form-control" name="Owners_first_name" id="fownerfirstname" type="text"
                                placeholder="Owner's first name" required
                                value="{{ old('Owners_first_name') ?? $document->owner_fname }}">
                        </div>
                        @error('Owners_first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-check-label text-capitalize">owner's last name <b
                                class="text-danger">*</b></label>
                        <div class="input-group input-group-outline">
                            <input class="form-control" name="Owners_last_name" id="fownerlastname" type="text"
                                placeholder="Owner's last name" required
                                value="{{ old('Owners_last_name') ?? $document->owner_lname }}">
                        </div>
                        @error('Owners_last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3" hidden>
                        <label class="form-check-label text-capitalize">reporter's email <b
                                class="text-danger">*</b></label>
                        <div class="input-group input-group-outline">
                            <input class="form-control " name="email_address" id="femailaddress" type="email"
                                placeholder="Your email" value="{{ old('email_address') ?? $document->reprter_email }}"
                                required>
                        </div>
                        @error('email_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3" hidden>
                        <label class="form-check-label text-capitalize">country code</label>
                        <div class="input-group input-group-outline">
                            <input class="form-control " name="fcountrycode" id="fcountrycode" type="text"
                                placeholder="Code" value="{{ old('fcountrycode') ?? $document->reporter_code }}"
                                required>
                        </div>
                        @error('fcountrycode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3" hidden>
                        <label class="form-check-label text-capitalize">
                            phone number
                        </label>
                        <div class="input-group input-group-outline">
                            <input class="form-control " name="phone_number" id="fphonenumber" type="text"
                                placeholder="Phone number"
                                value="{{ old('phone_number') ?? $document->reporter_phoneNumber }}" required>
                        </div>
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3" hidden>
                        <label class="form-check-label text-capitalize">reporter's first name</label>
                        <div class="input-group input-group-outline">
                            <input class="form-control " name="ffirst_name" id="freportername" type="text"
                                placeholder="First name" value="{{ old('first_name') ?? $document->reporter_fname }}"
                                required>
                        </div>
                        @error('ffirst_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 mb-3" hidden>
                        <label class="form-check-label text-capitalize">reporter's last name</label>
                        <div class="input-group input-group-outline">
                            <input class="form-control " name="flast_name" id="freporterlastname" type="text"
                                placeholder="Last name" value="{{ old('last_name') ?? $document->reporter_lname }}"
                                required>
                        </div>
                        @error('flast_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input class="form-control flocation" name="coordinates" id="flocation" type="text"
                        placeholder="Click the button on the right to fill here" required
                        value="{{ old('lost_or_found_from') ?? 'hello world' }}" hidden>
                    <div class="col-12 col-md-4 mb-3 mt-1">
                        <button class="btn fda-bg text-white mt-4 w-100">update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.querySelector(".GeoLocationBtn").addEventListener("click", (e) => {
            e.preventDefault();
            // Check if Geolocation is supported by the browser
            if (navigator.geolocation) {
                // Get the current position
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var long = position.coords.longitude;

                    // Do something with the latitude and longitude
                    document.querySelector('#latitude').value = lat;
                    document.querySelector('#longitude').value = long;
                    // Now you can assign these values to your elements or variables as needed
                    document.querySelector('.flocation').value = lat + "," + long;
                });
            } else {
                Swal.fire({
                    title: "This form uses your location, please allow your device to access your location",
                    showClass: {
                        popup: `
                         animate__animated
                         animate__fadeInUp
                         animate__faster`,
                    },
                    hideClass: {
                        popup: `
                         animate__animated
                         animate__fadeOutDown
                         animate__faster`,
                    },
                });
            }
        });
    </script>
@endpush
