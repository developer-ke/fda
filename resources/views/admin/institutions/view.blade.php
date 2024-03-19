@php
    $note = 'view institution';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card mx-2 mt-n4">
                    <div class="card-header">
                        <span>
                            <a href="{{ route('admin.institutions') }}">
                                <i class="fa fa-arrow-circle-left me-1"></i>
                                Back
                            </a>
                        </span>
                        <div class="d-flex">
                            <img src="{{ asset('assets/uploads/institutions/' . $institution->logo) }}" class="w-100"
                                alt="">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <h5 class="card-title text-sm text-capitalize ms-3">general info</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">Name:</b>
                                                {{ $institution->institutionName }}
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">location:</b>
                                                {{ $institution->location }}
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">country:</b>
                                                {{ $institution->countryName }}
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">city:</b>
                                                {{ $institution->city }}
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">created on:</b>
                                                {{ $institution->created_at->format('d/m/Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <h5 class="card-title text-sm text-capitalize ms-3">contact info</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">email:</b>
                                                {{ $institution->email }}
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">phone 1:</b>
                                                {{ $institution->code . $institution->phoneNumber }}
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">phone 2:</b>
                                                @if ($institution->altPhoneNumber === null)
                                                    null
                                                @else
                                                    {{ $institution->code . $institution->altPhoneNumber }}
                                                @endif
                                            </li>
                                            <li class="list-group-item text-sm border-0">
                                                <b class="text-capitalize me-1">address:</b>
                                                {{ $institution->address . ', ' . $institution->location . '.' }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <h5 class="card-title text-sm text-capitalize ms-3">Added by</h5>
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
                                        <h5 class="card-title text-sm text-capitalize ms-3 mt-2">Under</h5>
                                        <div class="d-flex">
                                            <div class="me-1">
                                                <img src="{{ asset('uploads/profiles/' . $institution->correspondentImage) }}"
                                                    alt="" class="avatar avatar-md">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-sm mb-0 text-capitalize">
                                                    {{ $institution->corresponderntName }}</h6>
                                                <p class="mt-0 mb-0 form-check-label">
                                                    {{ $institution->correspondentEmail }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="institutionMap" style="height: 400px;"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Correctly parsing the PHP variables into JavaScript
        var lat = {!! htmlspecialchars($institution->latitude) !!};
        var long = {!! htmlspecialchars($institution->longitude) !!};
        var institutionName = @json($institution->institutionName);
        var map = L.map('institutionMap').setView([lat, long], 13);

        // Adding OpenStreetMap tiles to the map
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        var markerIcon = L.icon({
            iconUrl: 'https://maps.google.com/mapfiles/ms/micons/blue-dot.png',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var markerShadow = L.icon({
            iconUrl: 'https://maps.google.com/mapfiles/ms/micons/msmarker.shadow.png',
            iconSize: [59, 32],
            iconAnchor: [16, 32],
            shadowUrl: 'https://maps.google.com/mapfiles/ms/micons/msmarker.shadow.png',
            shadowSize: [59, 32],
            shadowAnchor: [16, 32]
        });

        var marker = L.marker([lat, long], {
            icon: markerIcon,
            shadow: markerShadow
        }).addTo(map);

        marker.bindTooltip(institutionName, {
            permanent: false,
            direction: 'top'
        });
        marker.on('mouseover', function(e) {
            this.openTooltip();
        });

        marker.on('mouseout', function(e) {
            this.closeTooltip();
        });
    </script>
@endpush
