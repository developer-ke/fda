@php
    $note = 'cms';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.cms2.create') }}" class="btn fda-bg text-white">
                            <span class="fa fa-plus-circle"></span>
                            add
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="container">
                            <div class="dropdown open">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    more
                                </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    <form action="{{ route('admin.cms2.enableAll') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="dropdown-item text-capitalize @if ($adverts->where('status', 0)->count() < 1) d-none @endif"
                                            onclick="return confirm('Are you sure you want to enable all the adverts?')">
                                            <i class="fa fa-check-circle"></i>
                                            enable all
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.cms2.disableAll') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="dropdown-item text-capitalize @if ($adverts->where('status', 1)->count() < 1) d-none @endif"
                                            onclick="return confirm('Are you sure you want to disable al thel adverts?')">
                                            <i class="fa fa-check-circle"></i>
                                            disable all
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.cms2.deleteAll') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="dropdown-item text-capitalize @if ($adverts->where('status', 1)->count() < 1) d-none @endif"
                                            onclick="return confirm('Are you sure you want to delete all adverts?')">
                                            <i class="fa fa-check-circle"></i>
                                            delete all
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-top table-hover data-table">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>added by</th>
                            <th>image</th>
                            <th>status</th>
                            <th>date added</th>
                            <th>more</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($adverts as $advert)
                                <tr>
                                    <td>
                                        @php
                                            echo $counter;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-2">
                                                <img src="{{ asset('uploads/profiles/' . $advert->userImage) }}"
                                                    class="avatar avatar-md border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $advert->name }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ $advert->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mx-auto text-center">
                                            <img class="img-thumbnail w-50"
                                                src="{{ asset('assets/cms/' . $advert->image) }}" alt="image">
                                        </div>
                                    </td>
                                    <td>
                                        @if ($advert->status == 1)
                                            <span class="badge rounded-pill  bg-success">enabled</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">disabled</span>
                                        @endif
                                    </td>
                                    <td>{{ $advert->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="dropdown open">
                                            <a class="btn" type="button" id="triggerId" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="bi bi-three-dots-vertical"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="triggerId">
                                                <a class="dropdown-item text-capitalize"
                                                    href="{{ route('admin.cms2.edit', ['advert_id' => $advert->id]) }}">
                                                    <span class="fa fa-pen-square"></span>
                                                    edit
                                                </a>
                                                <a class="dropdown-item text-capitalize"
                                                    href="{{ route('admin.cms2.view', ['advert_id' => $advert->id]) }}">
                                                    <span class="fa fa-eye"></span>
                                                    view
                                                </a>
                                                <form
                                                    action="{{ route('admin.cms2.enable', ['advert_id' => $advert->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item @if ($advert->status == 1) d-none @endif"
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to enable this advert?')">
                                                        <span class="fa fa-check-circle"></span>
                                                        Enable
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.cms2.disable', ['advert_id' => $advert->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="dropdown-item @if ($advert->status == 0) d-none @endif"
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to disable this advert?')">
                                                        <span class="bi bi-x-circle"></span>
                                                        Disable
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.cms2.destroy', ['advert_id' => $advert->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="dropdown-item @if ($advert->status == 0) d-none @endif"
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this advert?')">
                                                        <span class="fa fa-trash"></span>
                                                        Delete
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
                    <tbody>

                    </tbody>
                </div>
            </div>
        </div>
    </div>
@endsection
