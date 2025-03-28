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
                        <a href="javascript:;" class="btn fda-bg text-white" data-bs-toggle="modal"
                            data-bs-target="#modalAddUSer">
                            <i class="fa fa-plus-circle"></i>
                            new user
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <div class="dropdown open d-flex align-items-center">
                            <button class="btn bg-danger text-white dropdown-toggle" type="button" id="triggerId"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                more
                            </button>
                            <div class="dropdown-menu dropdown-menu-start px-2 py-3 me-sm-n4" aria-labelledby="triggerId">
                                <form method="post" id="formGrantAccessAll">
                                    @csrf
                                    <button class="dropdown-item text-capitalize" type="submit"
                                        @if ($users->count() === $users->where('status', 1)->count()) hidden @endif>
                                        <i class="fa fa-check-circle"></i>
                                        Grant access to all users
                                    </button>
                                </form>
                                <form method="post" id="formDenyAccess">
                                    @csrf
                                    <button class="dropdown-item text-capitalize" type="submit"
                                        @if ($users->count() - 1 === $users->where('status', 0)->count()) hidden @endif>
                                        <i class="bi bi-x-circle"></i>
                                        Deny access to all users</button>
                                </form>
                                <form method="post" id="deleteAllUsers">
                                    @csrf
                                    <button class="dropdown-item text-capitalize" type="submit"
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
                    <table class="table w-100   table-hover" id="usersTable">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>role management</th>
                            <th>user</th>
                            <th>role</th>
                            <th>status</th>
                            <th>registered on</th>
                            <th>actions</th>
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
        const users = () => {
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
                        name: 'created_at',
                        render: function(data, type, row) {
                            const date = new Date(data);
                            const options = {
                                weekday: 'short',
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            };
                            return date.toLocaleDateString('en-US',
                                options); // Formats as 'Sat, 12 April, 2024'
                        }
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
        }
        $(document).ready(function() {
            users();
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
                       <img src="{{ asset('uploads/profiles/') }}/${user.image}" class="avatar avatar-md rounded-3" alt="user1">
                   </div>
                   <div class="d-flex flex-column justify-content-center">
                       <h6 class="mb-0 text-sm">${user.name}</h6>
                       <p class="text-sm text-secondary mb-0">${user.email}</p>
                   </div>
               </div>`;
        }
        const getUsers = () => {
            $('#usersTable').DataTable().ajax.reload(null,
                false);
        }
        const confirmRoleChange = (route, title, text, icon, confirmButtonText, formId, callback) => {
            Swal.fire({
                title,
                text,
                icon,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const res = await fetch(route, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        }
                    })
                    const output = await res.json();
                    if (output.success) {
                        successDialog(output.message);
                        callback();
                    } else if (output.error) {
                        console.log(output.message)
                        errorDialog('An error occured');
                    }
                }
            });
        }
        const changeRole = (url, title, text, btnText, formId) => {
            confirmRoleChange(url, title, text, 'warning', btnText, formId, getUsers);
        }
        const getRoleActions = (user) => {
            return `
            <div class='container'>
                <div class='row mx-auto'>
                    <div class='col-auto'>
                        <form id='toAdminForm_${user.id}'>
                            @csrf
                            <div class='form-check'>
                              <input class='form-check-input' type='radio' value='${user.id}' name='role' ${user.role === 1 ? 'checked disabled':''}  ${user.id === {{ Auth::user()->id }} ? 'disabled' : ''}  onclick="changeRole('/admin/users/${user.id}/role/1','Promotion','Are you sure, you want to promote?','Yes, Promote','toAdminForm_${user.id}')">
                              <label class='form-check-label'>Admin</label>
                           </div>
                        </form>
                    </div>
                     <div class='col-auto'>
                        <form action="" method="post" id='toCorrespondentForm_${user.id}'>
                            @csrf
                            @method('PUT')
                           <div class='form-check'>
                              <input class='form-check-input' type='radio' name='role' value='${user.id}' ${user.role === 2 ? 'checked disabled':''}  ${user.id === {{ Auth::user()->id }} ? 'disabled' : ''}   onclick="changeRole('/admin/users/${user.id}/role/2','Promotion/demotion','Are you sure, You want to promote or demote this user to correspondent?','Yes, promote/demote','toCorrespondentForm_${user.id}')">
                              <label class='form-check-label'>Correspondent</label>
                           </div>
                        </form>
                        
                    </div>
                     <div class='col-auto'>
                        <form action="" method="post" id='toSubscriberForm_${user.id}'>
                            @csrf
                            @method('PUT')
                           <div class='form-check'>
                              <input class='form-check-input' type='radio' name='role' value='${user.id}' ${user.role === 3 ? 'checked disabled':''}  ${user.id === {{ Auth::user()->id }} ? 'disabled' : ''}  onclick="changeRole('/admin/users/${user.id}/role/3','Demotion','Are you sure, You want to demote this user?','Yes, Demote','toSubscriberForm_${user.id}')">
                              <label class='form-check-label'>Subscriber</label>
                           </div>
                        </form>
                    </div>
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
                       <a class="dropdown-item" href="javascript:;" onclick="editUser(${user.id})">
                           <i class="fa fa-edit"></i>
                           edit
                       </a>
                       <a class="dropdown-item" href='javascript:;' onclick="showProfile(${user.id})">
                           <i class="fa fa-user-circle"></i>
                           profile
                       </a>
                       <button class="dropdown-item ${user.status === 1 ? 'd-none':''}" type="submit" onclick="grantAccess(${user.id})">
                           <i class="fa fa-check-circle"></i>
                           grant access
                       </button>
                       <button class="dropdown-item ${user.status === 0 || user.id === {{ Auth::user()->id }} ? 'd-none':''}" type="submit" onclick="denyAccess(${user.id})">
                           <i class="bi bi-x-circle-fill"></i>
                           deny access
                       </button>
                      <button 
                          class="dropdown-item ${user.status === 2 || user.id === {{ Auth::user()->id }} ? 'd-none' : ''}" 
                          onclick="deleteUser(${user.id})">
                          <i class="bi bi-trash-fill"></i>
                          delete
                      </button>
                   </div>
               </div>`;
        }

        const grantAccess = userID => {
            const route = `/admin/users/${userID}/grantAccess`;
            confirmDialog('You want to grant an access to this user?', 'Yes, Grant', route, getUsers, "PUT");
        }

        const denyAccess = userID => {
            const route = `/admin/users/${userID}/denyAccess`;
            confirmDialog('You want to deny an access to this user?', 'Yes, Deny', route, getUsers, "PUT");
        }
        // delete user
        const deleteUser = (userId) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/admin/users/${userId}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        });

                        const data = await response.json();

                        if (response.ok) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "User has been deleted.",
                                icon: "success"
                            });
                            // Optionally, refresh the user list or remove the user from the DOM
                            $('#usersTable').DataTable().ajax.reload(null,
                                false); // `false` prevents full reload
                        }
                    } catch (error) {
                        console.error('Error deleting user:', error);
                        alert('An error occurred. Please try again.');
                    }

                }
            });

        }
    </script>
@endpush
