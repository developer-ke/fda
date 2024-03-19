@php
    $note = 'document details';
@endphp
@extends('layouts.correspondent')
@section('content')
    <div class="mt-2">
        <div class="py-7 fda-bg text-center rounded-3">
            <img src="{{ asset('logo.png') }}" alt="agency logo" class="mx-auto">
        </div>
        <div class="card mt-n4 mx-2">
            <div class="card-header">
                <span>
                    <a href="{{ route('correspondent.drawer') }}">
                        <span class="fa fa-arrow-circle-left me-1"></span>
                        Back
                    </a>
                </span>
                <div class="d-flex mt-2">
                    <div class="me-1">
                        <img src="{{ asset('uploads/profiles/' . $drawer->image) }}" alt=""
                            class="avatar avatar-md rounded-3">
                    </div>
                    <div class="d-flex flex-column">
                        <h6 class="text-sm mb-0 text-capitalize">{{ $drawer->username }}</h6>
                        <p class="mt-0 mb-0 form-check-label">{{ $drawer->email }}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <h5 class="card-title text-sm text-capitalize">Name info</h5>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            first name:
                                        </b>
                                        {{ $drawer->firstName }}
                                    </li>
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            second name:
                                        </b>
                                        {{ $drawer->secondName }}
                                    </li>
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            last name:
                                        </b>
                                        {{ $drawer->lastName }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <h5 class="card-title text-sm text-capitalize">document info</h5>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            type:
                                        </b>
                                        {{ $drawer->documentType }}
                                    </li>
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            institution:
                                        </b>
                                        {{ $drawer->institutionName }}
                                    </li>
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            serial number:
                                        </b>
                                        {{ $drawer->serialNumber }}
                                    </li>
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            expiry date:
                                        </b>
                                        {{ $drawer->expiryDate }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <h5 class="card-title text-sm text-capitalize">status and dates</h5>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            status
                                        </b>
                                        @if ($drawer->status === 0)
                                            <span class="badge rounded-pill bg-danger">lost</span>
                                        @elseif($drawer->status === 1)
                                            <span class="badge rounded-pill bg-success">available</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">matched</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 text-sm text-capitalize mb-0 p-0">
                                        <b class="text-capitalize me-1">
                                            added on:
                                        </b>
                                        {{ $drawer->created_at->format('d/m/Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
