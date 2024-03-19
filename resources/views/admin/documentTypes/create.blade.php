@php
    $note = 'document types';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="py-6 fda-bg mx-auto text-center rounded-2">
            <img src="{{ asset('logo.png') }}" alt="" class="mx-auto">
        </div>
        <div class="card mx-2 mt-n4">
            <div class="card-header">
                <span>
                    <a href="{{ route('admin.documentTypes') }}" class="">
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        back
                    </a>
                </span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.documentTypes.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="container-fluid">
                                <label for="" class="form-check-label">Document type name</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="eg driving license" autofocus required >
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="conatiner-fluid mt-2">
                                <button class="btn fda-bg w-100 text-white mt-4">submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
