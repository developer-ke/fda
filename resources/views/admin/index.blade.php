@php
    $note = 'dashboard';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row mt-3" id="dashboard">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card  h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                        <h4 class="mb-0">{{ $users->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-capitalize text-sm">
                        inactive:
                        <span class="text-warning text-sm font-weight-bolder">
                            {{ $users->where('status', 0)->count() }} </span>
                        active:
                        <span class="text-success text-sm font-weight-bolder">
                            {{ $users->where('status', 1)->count() }} </span>
                        deleted:
                        <span class="text-danger text-sm font-weight-bolder">
                            {{ $users->where('status', 2)->count() }} </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">countries</p>
                        <h4 class="mb-0">{{ $countries->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">countries in the system</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2 bg-transparent">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">message</i>
                    </div>
                    <div class="text-end pt-1 h-100">
                        <p class="text-sm mb-0 text-capitalize ">messages</p>
                        <h4 class="mb-0 ">{{ $messages->where('status', false)->count() }}</h4>
                    </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3 h-100">
                    <p class="mb-0 text-capitalize text-sm">
                        replied:
                        <span class="text-warning text-sm font-weight-bolder">
                            {{ $messages->where('status', 1)->count() }} </span>
                        new:
                        <span class="text-success text-sm font-weight-bolder">
                            {{ $messages->where('status', 0)->count() }} </span>
                        trash:
                        <span class="text-danger text-sm font-weight-bolder">
                            {{ $messages->where('status', 2)->count() }} </span>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2 bg-transparent">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">
                            <span class='bi bi-badge-ad-fill   '></span>
                        </i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize ">adverts</p>
                        <h4 class="mb-0 ">
                            {{ $firstAdvert->count() + $secondAdvert->count() }}
                        </h4>
                    </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                    <p class="mb-0 text-capitalize text-center text-sm">
                        active:
                        <span class="text-warning text-sm font-weight-bolder">
                            {{ $firstAdvert->where('status', 1)->count() + $secondAdvert->where('status', 1)->count() }}
                        </span>
                        inactive:
                        <span class="text-success text-sm font-weight-bolder">
                            {{ $firstAdvert->where('status', 0)->count() + $secondAdvert->where('status', 0)->count() }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">types of document</p>
                        <h4 class="mb-0">{{ $types->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">types of documents</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">lost documents</p>
                        <h4 class="mb-0">{{ $lostDocuments->where('status', 0)->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">lost documents</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-md-3 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">claimed documents</p>
                        <h4 class="mb-0">
                            {{ $foundDocuments->where('status', 3)->count() + $lostDocuments->where('status', 3)->count() }}
                        </h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">claimed documents</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-md-3 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">matched documents</p>
                        <h4 class="mb-0">
                            {{ $foundDocuments->where('status', 2)->count() + $lostDocuments->where('status', 2)->count() }}
                        </h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">matched documents</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check-label text-capitalize">start date</div>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" onchange="startDateFilter(this.value)">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check-label text-capitalize">end date</div>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" onchange="endDateFilter(this.value)">
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <p class="text-sm mb-0 text-capitalize">page visits</p>
                            <h4 class="mb-0">
                                {{ $visits->count() }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-bookshelf"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">drawer</p>
                        <h4 class="mb-0">{{ $drawers->count() }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="drawersChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12  mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check-label text-capitalize">start date</div>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" onchange="startDateFilterLost(this.value)">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check-label text-capitalize">end date</div>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" onchange="endDateFilterLost(this.value)">
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <p class="text-sm mb-0 text-capitalize">lost documents</p>
                            <h4 class="mb-0">
                                {{ $lostDocuments->where('status')->count() }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="lostDocumentsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-lock"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">foundDocuments</p>
                        <b>{{ $foundDocuments->count() }}</b>
                    </div>
                </div>
                <div class="card-body">
                    <div id="foundDocsMap" style="height:400px ;"></div>
                </div>
            </div>
        </div>
        <div class="col-12  mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-bank"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">instititutions</p>
                        <b class="mb-0">{{ $institutions->count() }}</b>
                    </div>
                </div>
                <div class="card-body">
                    <div id="instituitionMap" style="height:400px ;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var institutions = @json($institutions);
        var map = L.map('instituitionMap').setView([0, 0], 1);
        // Adding OpenStreetMap tiles to the map (outside the loop)
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        institutions.forEach(institution => {
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

            var marker = L.marker([institution.latitude, institution.longitude], {
                icon: markerIcon,
                shadow: markerShadow
            }).addTo(map);

            marker.bindTooltip(institution.name, {
                permanent: false,
                direction: 'top'
            });
            marker.on('mouseover', function(e) {
                this.openTooltip();
            });

            marker.on('mouseout', function(e) {
                this.closeTooltip();
            });
        });

        // found documents
        var foundDocuments = @json($foundDocuments);
        var map = L.map('foundDocsMap').setView([0, 0], 1);
        // Adding OpenStreetMap tiles to the map (outside the loop)
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        foundDocuments.forEach(document => {
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

            var marker = L.marker([document.latitude, document.longitude], {
                icon: markerIcon,
                shadow: markerShadow
            }).addTo(map);

            marker.bindTooltip("Document's Serial Number:" + document.serialNumber, {
                permanent: false,
                direction: 'top'
            });
            marker.on('mouseover', function(e) {
                this.openTooltip();
            });

            marker.on('mouseout', function(e) {
                this.closeTooltip();
            });
        });

        // page visits
        const visits = @json($visits); // Assuming $visits is an array of visit objects
        const visitCounts = {};

        visits.forEach(visit => {
            // Extract the date without the time
            const date = new Date(visit.created_at).toLocaleDateString();

            // If the date is not in the visitCounts object, initialize its count to 1
            if (!visitCounts[date]) {
                visitCounts[date] = 1;
            } else {
                // If the date is already in the visitCounts object, increment its count
                visitCounts[date]++;
            }
        });

        // setup
        const data = {
            labels: Object.keys(visitCounts),
            datasets: [{
                    label: 'daily visits',
                    data: Object.values(visitCounts),
                    backgroundColor: [
                        'rgba(255, 26, 104, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(0, 0, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 26, 104, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(0, 0, 0, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    type: 'line', // Line chart dataset
                    label: 'Daily Visits (Line)',
                    data: Object.values(visitCounts),
                    borderColor: 'rgba(75, 192, 192, 1)', // Line color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Fill under the line
                    borderWidth: 2, // Line width
                    fill: true // Whether to fill the area under the line
                }
            ]
        };

        // config
        const config = {
            type: 'bar',
            data,
            options: {
                autoSkip: false,
                scales: {
                    x: {
                        min: null,
                        max: null,
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // render init block
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        const startDateFilter = startDate => {
            var startdate = new Date(startDate).toLocaleDateString();
            myChart.config.options.scales.x.min = startdate;
            myChart.update();
        }
        const endDateFilter = endDate => {
            var enddate = new Date(endDate).toLocaleDateString();
            myChart.config.options.scales.x.max = enddate;
            myChart.update();
        }

        // lost documents
        const lostDocuments = @json($lostDocuments); // Assuming $visits is an array of visit objects
        const lostDocs = {};
        const foundDocs = {};
        lostDocuments.forEach(document => {
            // Extract the date without the time
            const date = new Date(document.created_at).toLocaleDateString();

            // If the date is not in the visitCounts object, initialize its count to 1
            if (!lostDocs[date]) {
                lostDocs[date] = 1;
            } else {
                // If the date is already in the visitCounts object, increment its count
                lostDocs[date]++;
            }
        });
        foundDocuments.forEach(document => {
            // Extract the date without the time
            const date = new Date(document.created_at).toLocaleDateString();

            // If the date is not in the visitCounts object, initialize its count to 1
            if (!foundDocs[date]) {
                foundDocs[date] = 1;
            } else {
                // If the date is already in the visitCounts object, increment its count
                foundDocs[date]++;
            }
        });
        const lostDocumentCtx = document.getElementById('lostDocumentsChart');

        const lostChart = new Chart(lostDocumentCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(lostDocs), // Labels for x-axis
                datasets: [{
                        label: 'Lost Documents',
                        data: Object.values(lostDocs), // Data for lost documents
                        borderWidth: 1,
                        backgroundColor: [
                            '#C63D0F',
                        ],
                    },
                    {
                        label: 'Found Documents',
                        data: Object.values(foundDocs), // Data for found documents
                        borderWidth: 1,
                        backgroundColor: [
                            '#fdd490',
                        ],
                    }
                ]
            },
            options: {
                autoSkip: false,
                scales: {
                    x: {
                        min: null,
                        max: null
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        const startDateFilterLost = startDate => {
            var startdate = new Date(startDate).toLocaleDateString();
            lostChart.options.scales.x.min = startdate;
            lostChart.update();
        }
        const endDateFilterLost = endDate => {
            var enddate = new Date(endDate).toLocaleDateString();
            lostChart.options.scales.x.max = enddate;
            lostChart.update();
        }
    </script>
@endpush
