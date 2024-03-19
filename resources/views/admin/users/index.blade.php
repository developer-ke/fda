@php
    $note = 'users';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mx-auto">
        <div class="card shadow-none">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.users.create') }}" class="btn fda-bg text-white">
                            <i class="fa fa-plus-circle"></i>
                            add
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <div class="dropdown open d-flex align-items-center">
                            <button class="btn bg-danger text-white dropdown-toggle" type="button" id="triggerId"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                more
                            </button>
                            <div class="dropdown-menu dropdown-menu-start px-2 py-3 me-sm-n4" aria-labelledby="triggerId">
                                <form action="{{ route('admin.users.grantAllAccess') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button
                                        onclick="return confirm('Are you sure you want to grant an access to all users?')"
                                        class="dropdown-item text-capitalize" type="submit"
                                        @if ($users->count() === $users->where('status', 1)->count()) hidden @endif>
                                        <i class="fa fa-check-circle"></i>
                                        Grant access to all users
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.denyAllAccess') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button
                                        onclick="return confirm('Are you sure you want to deny an access to all users?')"
                                        class="dropdown-item text-capitalize" type="submit"
                                        @if ($users->count() - 1 === $users->where('status', 0)->count()) hidden @endif>
                                        <i class="bi bi-x-circle"></i>
                                        Deny access to all users</button>
                                </form>
                                <form action="{{ route('admin.users.delete.all') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Are you sure you want to delete all the users accounts?')"
                                        class="dropdown-item text-capitalize" type="submit"
                                        @if ($users->count() - 1 === $users->where('status', 2)->count()) hidden @endif>
                                        <i class="fa fa-trash"></i>
                                        delete all users
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover  data-table">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>role management</th>
                            <th>user</th>
                            <th>role</th>
                            <th>status</th>
                            <th>registered on</th>
                            <th>more</th>
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
                                        <div class="dropdown open">
                                            <button
                                                class="btn fda-bg dropdown-toggle text-white @if ($user->id === Auth::user()->id) disabled bg-danger @endif"
                                                type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                @if ($user->role === 1)
                                                    demote
                                                @elseif ($user->role === 2)
                                                    promote or demote
                                                @elseif ($user->role === 3)
                                                    promote
                                                @endif
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end text-capitalize"
                                                aria-labelledby="triggerId">
                                                <form action="{{ route('admin.users.role.one', ['user_id' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to promote this user to admin?')"
                                                        class="dropdown-item text-capitalize @if ($user->role === 1) d-none @endif"
                                                        type="submit">to
                                                        admin</button>
                                                </form>
                                                <form action="{{ route('admin.users.role.two', ['user_id' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to change the role of this user?')"
                                                        class="dropdown-item text-capitalize @if ($user->role === 2) d-none @endif"
                                                        type="submit">to
                                                        correspondent</button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.users.role.three', ['user_id' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to change the role of this user to correspondent?')"
                                                        class="dropdown-item text-capitalize @if ($user->role === 3) d-none @endif"
                                                        type="submit">to
                                                        subscriber</button>
                                                </form>
                                            </div>
                                        </div>
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
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-0 text-sm">
                                                @switch($user->role)
                                                    @case(1)
                                                        Admin
                                                    @break

                                                    @case(2)
                                                        Correspondent
                                                    @break

                                                    @case(3)
                                                        subscriber
                                                    @break
                                                @endswitch
                                            </h6>
                                            <p class="text-sm text-secondary mb-0">
                                                FoundDocument Agency
                                            </p>
                                        </div>
                                    </td>
                                    <td class="align-items-middle">
                                        @switch($user->status)
                                            @case(0)
                                                <span class="badge rounded-pill bg-warning">inactive</span>
                                            @break

                                            @case(1)
                                                <span class="badge rounded-pill bg-success">active</span>
                                            @break

                                            @case(2)
                                                <span class="badge rounded-pill bg-danger">deleted</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <div class="dropdown open">
                                            <a class="btn" type="button" id="users_dropdown" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-ellipsis-v"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end me-n4 text-capitalize"
                                                aria-labelledby="users_dropdown">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.users.profile.edit', ['user_id' => $user->id]) }}">
                                                    <i class="fa fa-edit"></i>
                                                    edit
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.users.profile', ['user_id' => $user->id]) }}">
                                                    <i class="fa fa-user-circle"></i>
                                                    profile
                                                </a>
                                                <form
                                                    action="{{ route('admin.users.grantAccess', ['user_id' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item @if ($user->status === 1) d-none @endif"
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to grant an access to this user?')">
                                                        <i class="fa fa-check-circle"></i>
                                                        grant access
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.users.denyAccess', ['user_id' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item  @if ($user->status === 0 || $user->id === Auth::user()->id) d-none @endif"
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to Deny and access?')">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                        deny access
                                                    </button>
                                                </form>

                                                <form
                                                    action="{{ route('admin.users.destroy', ['user_id' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item  @if ($user->status === 2 || $user->id === Auth::user()->id) d-none @endif"
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this account?')">
                                                        <i class="bi bi-trash-fill"></i>
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
