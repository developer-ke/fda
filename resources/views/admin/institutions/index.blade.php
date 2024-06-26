@php
    $note = 'institutions';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="card shadow-none">
            <div class="card-header">
                <a href="{{ route('admin.institutions.create') }}" class="btn fda-bg text-white">
                    <i class="bi bi-plus-circle"></i>
                    new
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover mb-0 data-table">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>added by</th>
                            <th>correspondent</th>
                            <th>institution name</th>
                            <th>logo</th>
                            <th>location info</th>
                            <th>contact info</th>
                            <th>status</th>
                            <th>added on</th>
                            <th>more</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($institutions as $institution)
                                <tr>
                                    <td>
                                        @php
                                            echo $counter;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-1">
                                                <img src="{{ asset('uploads/profiles/' . $institution->userImage) }}"
                                                    alt="" class="avatar avatar-md">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-sm mb-0 text-capitalize">{{ $institution->userName }}</h6>
                                                <p class="mt-0 mb-0 form-check-label">{{ $institution->userEmail }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-1">
                                                <img src="{{ asset('uploads/profiles/' . $institution->correspondentImage) }}"
                                                    alt="" class="avatar avatar-md">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-sm mb-0 text-capitalize">
                                                    {{ $institution->corresponderntName }}</h6>
                                                <p class="mt-0 mb-0 form-check-label">{{ $institution->correspondentEmail }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-capitalize">{{ $institution->institutionName }}</td>
                                    <td>
                                        <img src="{{ asset('assets/uploads/institutions/' . $institution->logo) }}"
                                            class="img" width="100px" height="100px" alt="">
                                    </td>
                                    <td>
                                        <div class="mx-auto">
                                            <p class="text-sm form-check-label">
                                                <b class="text-capitalize">Country:</b>{{ $institution->countryName }}
                                                <br>
                                                <b class="text-capitalize">City:</b>{{ $institution->city }}
                                                <br>
                                                <b class="text-capitalize">town:</b>{{ $institution->location }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mx-auto">
                                            <p class="text-sm form-check-label">
                                                <b class="text-capitalize me-1">email:</b>{{ $institution->email }}
                                                <br>
                                                <b class="text-capitalize me-1">phone 1:</b>
                                                {{ $institution->code . $institution->phoneNumber }}
                                                <br>
                                                <b class="text-capitalize me-1">phone 2:</b>
                                                @if ($institution->altPhoneNumber === null)
                                                    null
                                                @else
                                                    {{ $institution->code . $institution->altPhoneNumber }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($institution->status == 1)
                                            <span class="badge badge-pill bg-success">active</span>
                                        @else
                                            <span class="badge badge-pill bg-danger">inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $institution->created_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button id="my-dropdown" class="btn" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="bi bi-three-dots-vertical"></span>
                                                <span class="sr-only">click here</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="my-dropdown">
                                                <a class="dropdown-item text-capitalize"
                                                    href="{{ route('admin.institutions.view', ['institution_id' => $institution->id]) }}">
                                                    <i class="fa fa-eye"></i>
                                                    view
                                                </a>
                                                <a class="dropdown-item text-capitalize"
                                                    href="{{ route('admin.institutions.edit', ['institution_id' => $institution->id]) }}">
                                                    <i class="fa fa-pencil-square"></i>
                                                    edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.institutions.activate', ['institution_id' => $institution->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item text-capitalize @if ($institution->status === 1) d-none @endif"
                                                        onclick="return confirm('Are you sure you want to activate?')"
                                                        type="submit">
                                                        <i class="fa fa-check-circle"></i>
                                                        activate
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.institutions.deactivate', ['institution_id' => $institution->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item text-capitalize  @if ($institution->status === 0) d-none @endif"
                                                        onclick="return confirm('Are you sure you want to deactivate?')"
                                                        type="submit">
                                                        <i class="bi bi-x-circle"></i>
                                                        deactivate
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.institutions.delete', ['institution_id' => $institution->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button
                                                        class="dropdown-item text-capitalize  @if ($institution->status === 0) d-none @endif"
                                                        onclick="return confirm('Are you sure you want to delete this?')"
                                                        type="submit">
                                                        <i class="fa fa-trash"></i>
                                                        delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $counter += 1;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
