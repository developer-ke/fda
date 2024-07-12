@php
    $note = 'my drawer';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-middle table-bordered table-hover mb-0 data-table">
                        <thead class="text-uppercase text-sm  text-start">
                            <th>no</th>
                            <th>added by</th>
                            <th>details of the document</th>
                            <th>status</th>
                            <th>added on</th>
                            <th>more</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($drawers as $drawer)
                                <tr>
                                    <td>
                                        @php
                                            echo $counter;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-1">
                                                <img src="{{ asset('uploads/profiles/' . $drawer->image) }}" alt=""
                                                    class="avatar avatar-md">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-sm mb-0 text-capitalize">{{ $drawer->username }}</h6>
                                                <p class="mt-0 mb-0 form-check-label">{{ $drawer->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">first name:</b>
                                                {{ $drawer->firstName }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">middle name:</b>
                                                {{ $drawer->secondName }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">last name:</b>
                                                {{ $drawer->lastName }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">type of document:</b>
                                                {{ $drawer->documentType }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">serial number:</b>
                                                {{ $drawer->serialNumber }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">institution:</b>
                                                {{ $drawer->institutionName }}
                                            </li>
                                            <li class="list-group-item border-0 text-sm p-0">
                                                <b class="text-capitalize">expiry date:</b>
                                                {{ $drawer->expiryDate }}
                                            </li>

                                        </ul>
                                    </td>
                                    <td>
                                        @if ($drawer->status == 1)
                                            <span class="badge bg-success rounded-pill">available</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill">lost</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $drawer->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button id="my-dropdown" class="btn" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="bi bi-three-dots-vertical"></span>
                                                <span class="sr-only">click here</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="my-dropdown">
                                                <a class="dropdown-item text-capitalize"
                                                    href="{{ route('admin.clientsDrawer.view', ['drawer_id' => $drawer->id]) }}">
                                                    <i class="fa fa-eye"></i>
                                                    view
                                                </a>
                                                <a class="dropdown-item text-capitalize  @if ($drawer->status === 0 || $drawer->status === 2) d-none @endif"
                                                    href="{{ route('admin.clientsDrawer.edit', ['drawer_id' => $drawer->id]) }}">
                                                    <i class="fa fa-pencil-square"></i>
                                                    edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.clientsDrawer.lost', ['drawer_id' => $drawer->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item text-capitalize @if ($drawer->status === 1) d-none @endif"
                                                        onclick="return confirm('Are you sure you want to activate?')"
                                                        type="submit">
                                                        <i class="fa fa-check-circle"></i>
                                                        report as lost
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.clientsDrawer.found', ['drawer_id' => $drawer->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item text-capitalize @if ($drawer->status === 0) d-none @endif"
                                                        onclick="return confirm('Are you sure you want to deactivate?')"
                                                        type="submit">
                                                        <i class="bi bi-x-circle"></i>
                                                        report as found
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.clientsDrawer.destroy', ['drawer_id' => $drawer->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="dropdown-item text-capitalize @if ($drawer->status === 0) d-none @endif"
                                                        onclick="return confirm('Are you sure you want to delete this?')"
                                                        type="submit">
                                                        <i class="fa fa-trash"></i>
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
