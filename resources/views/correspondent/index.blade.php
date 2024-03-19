@php
    $note = 'dashboard';
@endphp
@extends('layouts.correspondent')
@section('content')
    <div class="row mt-3">
        <div class="col-lg-4 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-spreadsheet-fill"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">drawer</p>
                        <h4 class="mb-0">{{ $drawers->where('user_id', Auth::user()->id)->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">documents in the drawers</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-success shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">lost documents</p>
                        <h4 class="mb-0">
                            {{ $lostDocuments->where('status', 0)->where('email', Auth::user()->email)->count() }}

                        </h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">lost documents</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 mt-sm-0 mb-4">
            <div class="card h-100">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-success shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">found documents</p>
                        <h4 class="mb-0">
                            {{ $foundDocuments->where('status', 0)->where('reporter_email', Auth::user()->email)->count() }}

                        </h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-center">lost documents</p>
                </div>
            </div>
        </div>
    </div>
@endsection
