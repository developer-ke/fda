@php
    $note = 'advert details';
@endphp
@extends('layouts.admin')
@section('content')
    {{ $advert->image }}
    {{-- <div class="mt-2">
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <div class="container-fluid">
                        <img src="{{ asset('assets/cms/' . $advert->image) }}" class="img-fluid rounded-3 w-100" height="20px"
                            id="preview">
                    </div>
                </div>
                <div class="card  mx-3 mt-n5">
                    <div class="card-header">
                        <span class="text-capitalize">
                            <a href="{{ route('admin.cms2') }}">
                                <i class="fa fa-arrow-circle-o-left"></i>
                                back
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="d-flex">
                                    <div class="me-1">
                                        <img class="avatar avatatar-md  rounded-3"
                                            src="{{ asset('uploads/profiles/' . $advert->userImage) }}" alt="user profile">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h4 class="text-sm">{{ $advert->name }}</h4>
                                        <p class="form-check-label">{{ $advert->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0">
                                        <span class="fw-bold text-capitalize me-1">added on:</span>
                                        {{ $advert->created_at->format('d/m/Y') }}
                                    </li>
                                    <li class="list-group-item border-0">
                                        <span class="fw-bold text-capitalize me-1">status:</span>
                                        @if ($advert->status == 1)
                                            <span class="badge rounded-pill  bg-success">enabled</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">disabled</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
