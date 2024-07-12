@php
    $note = 'edit advert';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <span class="text-capitalize">
                        <a href="{{ route('admin.cms1') }}">
                            <i class="fa fa-arrow-circle-o-left"></i>
                            back
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cms1.update', ['advert_id' => $advert->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mx-0">
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">Header text</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" name="header" class="form-control"
                                            value="{{ old('header') ?? $advert->header }}" placeholder="type here....">
                                    </div>
                                    @error('header')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">Header text color</label>
                                    <div class="input-group input-group-outline">
                                        <input type="color" name="header_color" class="form-control"
                                            value="{{ old('header_color') ?? $advert->header_color }}">
                                    </div>
                                    @error('header_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">body text</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" name="body_text" class="form-control"
                                            value="{{ old('body_text') ?? $advert->body_text }}"
                                            placeholder="type here....">
                                    </div>
                                    @error('body_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">body text color</label>
                                    <div class="input-group input-group-outline">
                                        <input type="color" name="body_text_color" class="form-control"
                                            value="{{ old('body_text_color') ?? $advert->body_text_color }}">
                                    </div>
                                    @error('body_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">button's text</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" name="btn_text" class="form-control"
                                            value="{{ old('btn_text') ?? $advert->btn_text }}" placeholder="type here...">
                                    </div>
                                    @error('btn_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">button's text color</label>
                                    <div class="input-group input-group-outline">
                                        <input type="color" name="btn_text_color" class="form-control"
                                            value="{{ old('btn_text_color') ?? $advert->btn_text_color }}">
                                    </div>
                                    @error('btn_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">button's url</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" name="url" class="form-control"
                                            value="{{ old('url') ?? $advert->url }}" placeholder="type here...">
                                    </div>
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">button's background color</label>
                                    <div class="input-group input-group-outline">
                                        <input type="color" name="btn_bg" class="form-control"
                                            value="{{ old('btn_bg') ?? $advert->btn_bg }}">
                                    </div>
                                    @error('btn_bg')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">container's background color</label>
                                    <div class="input-group input-group-outline">
                                        <input type="color" name="div_bg" class="form-control"
                                            value="{{ old('div_bg') ?? $advert->div_bg }}">
                                    </div>
                                    @error('div_bg')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">carousel image</label>
                                    <div class="input-group input-group-outline">
                                        <input type="file" onchange="showImage(this)" name="image"
                                            class="form-control" value="{{ old('image') ?? $advert->image }}">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="container">
                                    <img src="{{ asset('assets/cms/' . $advert->image) }}"
                                        class="img-fluid rounded-top mb-3" alt="" id="preview">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn fda-bg text-white w-100">update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
