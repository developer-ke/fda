@php
    $note = 'found documents';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="card shadow-none">
            <div class="card-header">
                <a href="{{ route('admin.foundDocuments.create') }}" class="btn fda-bg text-white">
                    <i class="bi bi-plus-circle"></i>
                    report found document
                </a>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table  data-table">
                            <thead class="text-capitalize text-sm">
                                <th>callapse</th>
                                <th>no</th>
                                <th>document details</th>
                                <th>owner's details</th>
                                <th>reporter's details</th>
                                <th>status</th>
                                <th>date</th>
                                <th>more</th>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($documents as $document)
                                    @php
                                        echo $counter += 1;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="dropdown mx-auto">
                                                <button class="btn  dropdown-toggle btn-xlg" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseRow{{ $counter }}" aria-expanded="false"
                                                    aria-controls="collapseRow{{ $counter }}">
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                echo $counter;
                                            @endphp
                                        </td>
                                        <td>
                                            <b class="text-capitalize">type of document:</b>
                                            {{ $document->typOfDocument }}
                                        </td>
                                        <td>
                                            <ul class="list-group ms-3">

                                                {{ $document->owner_fname }} {{ $document->owner_lname }}
                                            </ul>
                                        </td>
                                        <td>
                                            {{ $document->reporter_fname }} {{ $document->reporter_lname }}
                                        </td>
                                        <td>
                                            @if ($document->status === 0)
                                                <span class="badge rounded-pill  bg-danger">Found</span>
                                            @elseif ($document->status === 2)
                                                <span class="badge rounded-pill  bg-warning">matched</span>
                                            @elseif ($document->status === 3)
                                                <span class="badge rounded-pill  bg-success">claimed</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $document->created_at->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            <div class="dropdown open">
                                                <button class="btn" type="button" id="triggerId"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="bi bi-three-dots-vertical b bold"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end text-capitalize"
                                                    aria-labelledby="triggerId">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.foundDocuments.edit', ['document_id' => $document->id]) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                        edit
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.foundDocuments.view', ['document_id' => $document->id]) }}">
                                                        <i class="bi bi-eye"></i>
                                                        view
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.foundDocuments.match', ['document_id' => $document->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="dropdown-item text-capitalize @if ($document->status === 2) d-none @endif"
                                                            onclick="return confirm('Are you sure you want to  mark this document as matched?')">
                                                            <span class="bi bi-check2"></span>
                                                            mark as matched
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.foundDocuments.claim', ['document_id' => $document->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="dropdown-item text-capitalize  @if ($document->status != 2) d-none @endif"
                                                            onclick="return confirm('Are you sure you want to  mark this document as claimed?')">
                                                            <span class="bi bi-check2-circle"></span>
                                                            mark as claimed
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.foundDocuments.destroy', ['document_id' => $document->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-capitalize"
                                                            onclick="return confirm('Are you sure you want to delete this document?')">
                                                            <span class="bi bi-trash"></span>
                                                            delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="collapse " id="collapseRow{{ $counter }}">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <ul class="list-group ms-3 h-100">
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">serial number:</b>
                                                    {{ $document->serialNumber }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">institution on document:</b>
                                                    {{ $document->institution_on_document }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">country on:</b>
                                                    {{ $document->countryName }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">city on:</b>
                                                    {{ $document->city }}
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group ms-3">
                                                <li class="list-group-item border-0  p-0 text-sm">
                                                    <b class="text-capitalize">first name:</b>
                                                    {{ $document->owner_fname }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">second name:</b>
                                                    {{ $document->owner_lname }}
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group ms-3">
                                                <li class="list-group-item border-0  p-0 text-sm">
                                                    <b class="text-capitalize">first name:</b>
                                                    {{ $document->reporter_fname }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">second name:</b>
                                                    {{ $document->reporter_lname }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">email:</b>
                                                    {{ $document->reprter_email }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">Phone number:</b>
                                                    {{ $document->reporter_code . $document->reporter_phoneNumber }}
                                                </li>
                                            </ul>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
