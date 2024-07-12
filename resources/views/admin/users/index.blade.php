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
                    <table class="table w-100 table-striped table-bordered table-hover" id="usersTable">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>role management</th>
                            <th>user</th>
                            <th>role</th>
                            <th>status</th>
                            <th>registered on</th>
                            <th>more</th>
                        </thead>
                        <tbody id="userTbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.users.fetch') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'counter',
                        name: 'counter',
                    },
                    {
                        data: 'role',
                        name: 'role',
                        render: function(data, type, user) {
                            return getRoleActions(user);
                        }
                    },
                    {
                        data: null,
                        name: 'name',
                        render: function(data, type, user) {
                            return renderUserDetails(user);
                        }
                    },
                    {
                        data: 'role',
                        name: 'role',
                        render: function(data, type, user) {
                            return getRoleText(data);
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, user) {
                            return getStatusBadge(data);
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, user) {
                            return renderActions(user);
                        }
                    }
                ]
            });
        });

        const getRoleText = (role) => {
            switch (role) {
                case 1:
                    return 'Admin';
                case 2:
                    return 'Correspondent';
                case 3:
                    return 'Subscriber';
                default:
                    return '';
            }
        }

        const getStatusBadge = (status) => {
            switch (status) {
                case 0:
                    return '<span class="badge badge-sm bg-warning">Inactive</span>';
                case 1:
                    return '<span class="badge badge-sm bg-gradient-success">Active</span>';
                case 2:
                    return '<span class="badge badge-sm bg-danger">Deleted</span>';
                default:
                    return '';
            }
        }

        const renderUserDetails = (user) => {
            return `
               <div class="d-flex">
                   <div class="me-2">
                       <img src="{{ asset('uploads/profiles/') }}/${user.image}" class="avatar avatar-md border-radius-lg" alt="user1">
                   </div>
                   <div class="d-flex flex-column justify-content-center">
                       <h6 class="mb-0 text-sm">${user.name}</h6>
                       <p class="text-sm text-secondary mb-0">${user.email}</p>
                   </div>
               </div>`;
        }

        const getRoleActions = (user) => {
            return `
                <div class="dropdown open">
                    <button class="btn fda-bg dropdown-toggle text-white ${user.id === {{ Auth::user()->id }} ? 'disabled bg-danger' : ''}" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ${user.role === 1 ? 'Demote' : user.role === 2 ? 'Promote or Demote' : user.role === 3 ? 'Promote' : ''}
                    </button>
                    <div class="dropdown-menu dropdown-menu-end text-capitalize" aria-labelledby="triggerId">
                        <form action="/admin/users/${user.id}/role/1" method="post">
                            @csrf
                            @method('PUT')
                            <button onclick="return confirm('Are you sure you want to promote this user to admin?')" class="dropdown-item text-capitalize ${user.role === 1 ? 'd-none' : ''}" type="submit">
                                To admin
                            </button>
                        </form>
                        <form action="/admin/users/${user.id}/role/2" method="post">
                            @csrf
                            @method('PUT')
                            <button onclick="return confirm('Are you sure you want to change the role of this user?')" class="dropdown-item text-capitalize ${user.role === 2 ? 'd-none' : ''}" type="submit">to correspondent</button>
                        </form>
                        <form action="/admin/users/${user.id}/role/3" method="post">
                            @csrf
                            @method('PUT')
                            <button onclick="return confirm('Are you sure you want to change the role of this user to correspondent?')" class="dropdown-item text-capitalize ${user.role === 3 ? 'd-none' : ''}" type="submit">to subscriber</button>
                        </form>
                    </div>
                </div>`;
        }

        const renderActions = (user) => {
            return `
               <div class="dropdown open">
                   <a class="btn" type="button" id="users_dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="fa fa-ellipsis-v"></span>
                   </a>
                   <div class="dropdown-menu dropdown-menu-end me-n4 text-capitalize" aria-labelledby="users_dropdown">
                       <a class="dropdown-item" href="/admin/users/${user.id}/edit/profile">
                           <i class="fa fa-edit"></i>
                           edit
                       </a>
                       <a class="dropdown-item" href="/admin/users/${user.id}/profile">
                           <i class="fa fa-user-circle"></i>
                           profile
                       </a>
                       <form action="/admin/users/${user.id}/grantAccess" method="post">
                           @csrf
                           @method('PUT')
                           <button class="dropdown-item ${user.status === 1 ? 'd-none':''}" type="submit" onclick="return confirm('Are you sure you want to grant access to this user?')">
                               <i class="fa fa-check-circle"></i>
                               grant access
                           </button>
                       </form>
                       <form action="/admin/users/${user.id}/denyAccess" method="post">
                           @csrf
                           @method('PUT')
                           <button class="dropdown-item ${user.status === 1 || user.id === {{ Auth::user()->id }} ? 'd-none':''}" type="submit" onclick="return confirm('Are you sure you want to deny access?')">
                               <i class="bi bi-x-circle-fill"></i>
                               deny access
                           </button>
                       </form>
                       <form action="/admin/users/${user.id}/delete" method="post">
                           @csrf
                           @method('PUT')
                           <button class="dropdown-item ${user.status === 2 || user.id === {{ Auth::user()->id }} ? 'd-none':''}" type="submit" onclick="return confirm('Are you sure you want to delete this account?')">
                               <i class="bi bi-trash-fill"></i>
                               delete
                           </button>
                       </form>
                   </div>
               </div>`;
        }
    </script>
@endpush
