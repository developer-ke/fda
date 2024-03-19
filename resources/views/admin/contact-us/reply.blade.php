@php
    $note = 'reply message';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="card shadow-none">
            <div class="card-header">
                <span>
                    <a href="{{ route('admin.contact-us') }}">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back
                    </a>
                </span>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="{{ route('admin.contact-us.send', ['contact_id' => $message->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="container-fluid mb-3">
                                            <label class="form-check-label">Name</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" value="{{ $message->name ?? $name }}" name="name"
                                                    class="form-control">
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="container-fluid mb-3">
                                            <label class="form-check-label">Email</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" value="{{ $message->email ?? $email }}" name="email"
                                                    class="form-control">
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="container-fluid mb-3">
                                            <label class="form-check-label">Subject</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" value="{{ $message->subject ?? $subject }}"
                                                    name="subject" class="form-control">
                                            </div>
                                            @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="container-fluid mb-3">
                                    <label class="form-check-label">Message</label>
                                    <div class="input-group input-group-outline">
                                        <textarea name="message" class="form-control" cols="30" rows="10">{{ $message->message ?? $message }}</textarea>
                                    </div>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn fda-bg text-white w-100 mt-3">
                                    send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
