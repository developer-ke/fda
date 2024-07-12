@php
    $note = 'permissions';
@endphp
@extends('layouts.admin')
@section('content')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="card shadow-none mt-5">
            <div class="py-5 mt-n5 fda-bg mx-3 rounded-3 text-center">
                <h4 class="text-capitalize text-white">
                    role management
                </h4>
            </div>

            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <span class="ms-2">
                            <a href="{{ route('admin.users') }}">
                                <i class="fa fa-arrow-circle-left"></i>
                                Back
                            </a>
                        </span>
                    </div>
                    <div class="col-6 align-items-end">
                        <button type="submit" class="btn fda-bg text-white">
                            submit roles
                        </button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered w-100 align-items-center data-table">
                        <thead>
                            <th>no</th>
                            <th>user</th>
                            <th>admin</th>
                            <th>correspondent</th>
                            <th>subscriber</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @php
                                            echo $counter;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-2    ">
                                                <img src="{{ asset('uploads/profiles/' . $user->image) }}"
                                                    class="avatar avatar-md border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container text-center">
                                            <div class="input-group input-group-outline text-center">
                                                <input type="radio" name="role" class="form-check-lg mx-auto"
                                                    @if ($user->role === 1) checked @endif>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container text-center">
                                            <div class="input-group input-group-outline text-center">
                                                <input type="radio" name="role" class="form-check-lg mx-auto"
                                                    @if ($user->role === 2) checked @endif>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container text-center">
                                            <div class="input-group input-group-outline text-center">
                                                <input type="radio" name="role" class="form-check-lg mx-auto"
                                                    @if ($user->role === 3) checked @endif>
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
    </form>
@endsection
