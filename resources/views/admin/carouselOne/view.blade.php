@php
    $note = 'advert details';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <div class="container-fluid">
                        <img src="{{ asset('assets/cms/' . $advert->image) }}" class="img-fluid rounded-3 h-50" height="20px"
                            id="preview">
                    </div>
                </div>
                <div class="card  mx-3 mt-n5">
                    <div class="card-header">
                        <span class="text-capitalize">
                            <a href="{{ route('admin.cms1') }}">
                                <i class="fa fa-arrow-circle-o-left"></i>
                                back
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">Header:</span>
                                                {{ $advert->header }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">body:</span>
                                                {{ $advert->body_text }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">button's text:</span>
                                                {{ $advert->btn_text }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">Url:</span>
                                                {{ $advert->url }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">added on:</span>
                                                {{ $advert->created_at->format('d/m/Y') }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">status:</span>
                                                @if ($advert->status === 1)
                                                    <span class="badge rounded-pill bg-success">enabled</span>
                                                @else
                                                    <span class="badge rounded-pill bg-success">disabled</span>
                                                @endif
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <ul class="list-group align-items-center">
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">container's color:</span>
                                                <input type="color" value="{{ $advert->div_color }}" id="">
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">header's color:</span>
                                                <input type="color" value="{{ $advert->header_color }}" id="">
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">body text color:</span>
                                                <input type="color" value="{{ $advert->body_text_color }}" id="">
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">button's text color:</span>
                                                <input type="color" value="{{ $advert->btn_color }}" id="">
                                            </li>
                                            <li class="list-group-item border-0 text-sm">
                                                <span class="text-capitalize fw-bold">button's background color:</span>
                                                <input type="color" value="{{ $advert->btn_bg }}" id="">
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
    </div>
@endsection
