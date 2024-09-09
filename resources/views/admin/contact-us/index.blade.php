@php
    $note = 'client support';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mx-auto">
        <div class="card shadow-none" id="client_surpport">
            <div class="card-header">
                <div class="dropdown open">
                    <a class="rounded-pill  text-dark" type="button" id="triggerId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="bi bi-three-dots-vertical p-1"></span>
                    </a>
                    <div class="dropdown-menu text-capitalize" aria-labelledby="triggerId">
                        <!-- Inbox Dropdown Item -->
                        <a class="dropdown-item mb-2 @if ($contacts->where('status', 0)->count() < 1) d-none @endif" href="javascript:;">
                            <i class="fa fa-envelope"></i>
                            inbox
                            <span class="badge rounded-pill bg-danger text-white p-1">
                                {{ $contacts->where('status', 0)->count() }}
                            </span>
                        </a>
                        <!-- Trash Dropdown Item -->
                        <a onclick="showTrash()" href="javascript:;"
                            class="dropdown-item mb-2 @if ($contacts->where('status', 2)->count() < 1) d-none @endif">
                            <i class="fa fa-trash"></i>
                            trash
                            <span class="badge rounded-pill bg-danger text-white p-1">
                                {{ $contacts->where('status', 2)->count() }}
                            </span>
                        </a>
                        <!-- Mark All As Read Form -->
                        <form action="{{ route('admin.contact-us.read.all') }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="dropdown-item mb-2 @if ($contacts->where('status', 0)->count() < 1) d-none @endif"
                                type="submit">
                                <i class="fa fa-check-circle"></i>
                                mark all as read
                            </button>
                        </form>
                        <!-- Mark All As Unread Form -->
                        <form action="{{ route('admin.contact-us.unread.all') }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="dropdown-item mb-2 @if ($contacts->where('status', 1)->count() < 1) d-none @endif">
                                <i class="bi bi-x-circle"></i>
                                mark all as unread
                            </button>
                        </form>
                        <!-- Delete All Form -->
                        <form action="{{ route('admin.contact-us.delete.all') }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="dropdown-item mb-2 @if ($contacts->whereIn('status', [0, 1])->count() < 1) d-none @endif">
                                <i class="fa fa-trash-o"></i>
                                delete all
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover data-table">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>sender</th>
                            <th>Email</th>
                            <th>status</th>
                            <th>date sent</th>
                            <th>more</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($contacts->whereIn('status', [0, 1]) as $contact)
                                <tr>
                                    <td>@php echo $counter; @endphp</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <h4
                                                class="text-capitalize
                                            text-sm mb-0">
                                                {{ $contact->name }}
                                            </h4>
                                            <p class="form-check-label mt-0">
                                                {{ $contact->email }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <h4
                                                class="text-capitalize
                                            text-sm mb-0">
                                                {{ $contact->subject }}
                                            </h4>
                                            <p class="form-check-label mt-0">
                                                {{ $contact->message }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($contact->status)
                                            @case(0)
                                                <span class="badge badge-pill bg-danger">new</span>
                                            @break

                                            @case(1)
                                                <span class="badge badge-pill bg-success">seen</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{ $contact->created_at->format('D, d M, Y') }}</td>
                                    <td>
                                        <div class="dropdown open">
                                            <a class="btn" type="button" id="users_dropdown" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-ellipsis-v"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end me-n4 text-capitalize"
                                                aria-labelledby="users_dropdown">
                                                <!-- Reply Dropdown Item -->
                                                <a href="{{ route('admin.contact-us.reply', ['client_id' => $contact->id]) }}"
                                                    class="dropdown-item text-capitalize">
                                                    <span class="fa fa-reply"></span>
                                                    reply
                                                </a>
                                                <!-- Mark As Read Form -->
                                                <form
                                                    action="{{ route('admin.contact-us.read', ['contact_id' => $contact->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item text-capitalize @if ($contact->status == 1 || $contact->status == 2) d-none @endif">
                                                        <i class="fa fa-check-circle"></i>
                                                        mark as read
                                                    </button>
                                                </form>
                                                <!-- Mark As Unread Form -->
                                                <form
                                                    action="{{ route('admin.contact-us.unread', ['contact_id' => $contact->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item text-capitalize @if ($contact->status == 0 || $contact->status == 2) d-none @endif">
                                                        <i class="bi bi-x-circle"></i>
                                                        mark as unread
                                                    </button>
                                                </form>
                                                <!-- Delete Form -->
                                                <form
                                                    action="{{ route('admin.contact-us.delete', ['contact_id' => $contact->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this?')"
                                                        class="dropdown-item text-capitalize @if ($contact->status == 0 || $contact->status == 2) d-none @endif">
                                                        <i class="bi bi-trash"></i>
                                                        delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php $counter += 1; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Trash Card -->
        <div class="card shadow-none mt-2" id="trashCard" hidden>
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <span>
                            <a href="javascript:;" onclick="showClientCard()" class="text-capitalize me-1">
                                <i class="fa fa-arrow-alt-circle-left"></i>back
                            </a>
                        </span>
                    </div>
                    <div class="col-6">
                        <div class="dropdown open">
                            <button class="btn bg-danger dropdown-toggle text-white" type="button" id="triggerId"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                more
                            </button>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                <form action="{{ route('admin.contact-us.restore.all') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="dropdown-item">
                                        <i class="bi bi-recycle"></i>
                                        Restore all
                                    </button>
                                </form>
                                <form action="{{ route('admin.contact-us.empty.trash') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item">
                                        <i class="bi bi-trash"></i>
                                        Empty trash
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover data-table">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>name</th>
                            <th>email</th>
                            <th>subject</th>
                            <th>message</th>
                            <th>more</th>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach ($contacts->where('status', 2) as $contact)
                                <tr>
                                    <td>@php echo $counter; @endphp</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="dropdown open">
                                            <a class="btn" type="button" id="users_dropdown"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-ellipsis-v"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end me-n4 text-capitalize"
                                                aria-labelledby="users_dropdown">
                                                <!-- Restore Dropdown Item -->
                                                <form
                                                    action="{{ route('admin.contact-us.restore.message', ['contact_id' => $contact->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item text-capitalize">
                                                        <span class="fa fa-recycle"></span>
                                                        Restore
                                                    </button>
                                                </form>
                                                <!-- Delete Permanently Form -->
                                                <form onclick="return confirm('Are you sure you want to delete this?')"
                                                    action="{{ route('admin.contact-us.empty.message', ['contact_id' => $contact->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-capitalize">
                                                        <i class="bi bi-trash"></i>
                                                        delete permanently
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php $counter += 1; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const showTrash = () => {
                const trashCard = document.querySelector('#trashCard');
                const clientsCard = document.querySelector('#client_surpport');
                trashCard.hidden = false;
                clientsCard.hidden = true;
            }
            const showClientCard = () => {
                const trashCard = document.querySelector('#trashCard');
                const clientsCard = document.querySelector('#client_surpport');
                trashCard.hidden = true;
                clientsCard.hidden = false;
            }
        </script>
    @endpush
@endsection
