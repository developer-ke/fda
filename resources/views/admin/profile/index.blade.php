@php
    $note = 'profile';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row mx-auto">
        <div class="col-12">
            <div class="page-header py-8 fda-bg text-center rounded-3">
                <img src="{{ asset('logo.png') }}" alt="FoundDocument logo" class="mx-auto">
            </div>
            <div class="card mt-n5 mx-2">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="me-2">
                            <img src="{{ asset('uploads/profiles/' . $user->image) }}" alt=""
                                class="avatar rounded-3 avatar-xl">
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="text-sm mb-0">
                                {{ $user->name }}
                            </h6>
                            <p class="mt-0">
                                {{ $user->email }}
                                <br>
                                <a href="{{ route('admin.profile.edit') }}" class="fda-color">
                                    <i class="fa fa-pencil-square"></i>
                                    Edit
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <h6 class="text-sm text-capitalize ms-3  fda-color">
                                        Biometric info
                                    </h6>
                                    <ul class="list-group text-sm">
                                        <li class="list-group-item border-0 mb-0 pb-0">
                                            <b class="text-capitalize me-1">name:</b>
                                            {{ $user->name }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">gender:</b>
                                            {{ $user->gender }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">date of birth:</b>
                                            {{ $user->dateOfBirth }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">country:</b>
                                            {{ $user->countryName }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">nationality:</b>
                                            {{ $user->nationality }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">city:</b>
                                            {{ $user->city }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <h6 class="text-sm text-capitalize ms-3  fda-color">
                                        contact info
                                    </h6>
                                    <ul class="list-group text-sm">
                                        <li class="list-group-item border-0 mb-0 pb-0">
                                            <b class="text-capitalize me-1">email:</b>
                                            {{ $user->email }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">phone 1:</b>
                                            {{ $user->code . $user->phoneNumber }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">phone 2:</b>
                                            {{ $user->code . $user->altPhoneNumber }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">location:</b>
                                            {{ $user->physicalAddress }}
                                        </li>
                                        <li class="list-group-item border-0 mb-0 pb-0">
                                            <b class="text-capitalize me-1">organization:</b>
                                            {{ $user->organization }}
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <h6 class="text-sm text-capitalize ms-3  fda-color">
                                        Account info
                                    </h6>
                                    <ul class="list-group text-sm">
                                        <li class="list-group-item border-0 mb-0 pb-0">
                                            <b class="text-capitalize me-1">role:</b>
                                            @switch($user->role)
                                                @case(1)
                                                    Admin
                                                @break

                                                @case(2)
                                                    correspondent
                                                @break

                                                @default
                                                    subscriber
                                            @endswitch
                                        </li>
                                        <li class="list-group-item border-0 mb-0 pb-0">
                                            <b class="text-capitalize me-1">status:</b>
                                            <span class="badge rounded-pill bg-success">active</span>
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">registered on:</b>
                                            {{ $user->created_at->format('D, d F, Y') }}
                                        </li>
                                        <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                            <b class="text-capitalize me-1">email verified on:</b>
                                            {{ $user->email_verified_at->format('D, d F, Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
