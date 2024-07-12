@php
    $note = 'found document';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="page-header mt-2 fda-bg py-8 text-center rounded-3">
        <img src="{{ asset('logo.png') }}" class="mx-auto" alt="">
    </div>
    <div class="card shadow-none mt-n5 mx-2">
        <div class="card-header">
            <span>
                <a href="{{ route('admin.foundDocuments') }}">
                    <i class="bi bi-arrow-left-circle me-1"></i>
                    Back
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class=" col-12 col-md-3">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">document's details</h6>
                            <ul class="list-group h-100">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">type of document:</b>
                                    {{ $document->typOfDocument }}
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
                <div class="col-12 col-md-3">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">owner's details</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">first name:</b>
                                    {{ $document->owner_fname }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">second name:</b>
                                    {{ $document->owner_lname }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">reporter's details</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">first name:</b>
                                    {{ $document->reporter_fname }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">second name:</b>
                                    {{ $document->reporter_lname }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">email:</b>
                                    {{ $document->reprter_email }}
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">Phone number:</b>
                                    {{ $document->reporter_code . $document->reporter_phoneNumber }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card shadow-none h-100">
                        <div class="card-body">
                            <h6 class="text-sm text-capitalize">other details</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0  p-0 text-sm">
                                    <b class="text-capitalize">status:</b>
                                    @if ($document->status === 0)
                                        <span class="badge rounded-pill  bg-danger">Found</span>
                                    @elseif ($document->status === 2)
                                        <span class="badge rounded-pill  bg-warning">matched</span>
                                    @elseif ($document->status === 3)
                                        <span class="badge rounded-pill  bg-success">claimed</span>
                                    @endif
                                </li>
                                <li class="list-group-item border-0 p-0 text-sm">
                                    <b class="text-capitalize">reported on:</b>
                                    {{ $document->created_at->format('d/m/Y') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
