@php
    $note = 'new advert';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <span class="text-capitalize">
                        <a href="{{ route('admin.cms2') }}">
                            <i class="fa fa-arrow-circle-o-left"></i>
                            back
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cms2.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mx-0">
                            <div class="col-12">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label text-capitalize">carousel image</label>
                                    <div class="input-group input-group-outline">
                                        <input type="file" onchange="showImage(this)" name="image" class="form-control"
                                            value="{{ old('image') }}">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="container">
                                    <img src="" class="img-fluid rounded-top mb-3" alt="" id="preview">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn fda-bg text-white w-100">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
