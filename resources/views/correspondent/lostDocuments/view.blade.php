@php
    $note = 'lost document';
@endphp
@extends('layouts.correspondent')
@section('content')
    <div class="page-header mt-2 fda-bg py-8 text-center rounded-3">
        <img src="{{ asset('logo.png') }}" class="mx-auto" alt="">
    </div>
    <div class="card shadow-none mt-n5 mx-2">
        <div class="card-header">
            <span>
                <a href="{{ route('correspondent.lostDocuments') }}">
                    <i class="bi bi-arrow-left-circle me-1"></i>
                    Back
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">document's details</h6>
                            <ul class="list-group  h-100">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">type of document:</b>
                                    {{ $document->documentType }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">serial number:</b>
                                    {{ $document->serialNumber }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">institution on document:</b>
                                    {{ $document->institution_on_document }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">police reference:</b>
                                    {{ $document->police_ref_number }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">location lost:</b>
                                    {{ $document->location }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">country on:</b>
                                    {{ $document->countryName }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">city on:</b>
                                    {{ $document->city }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">owner's details</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">first name:</b>
                                    {{ $document->firstName }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">second name:</b>
                                    {{ $document->lastName }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">email address:</b>
                                    {{ $document->email }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">phone number:</b>
                                    {{ $document->code . $document->phoneNumber }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize"> physical address:</b>
                                    {{ $document->location }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">other details</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">date reported:</b>
                                    {{ $document->created_at->format('d/m/Y') }}
                                </li>

                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize"> status:</b>
                                    <span class="badge rounded-pill bg-danger">lost</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
