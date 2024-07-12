@php
    $note = 'lost documents';
@endphp
@extends('layouts.correspondent')
@section('content')
    <div class="mt-2">
        <div class="card shadow-none">
            <div class="card-header">
                <a href="{{ route('correspondent.lostDocuments.create') }}" class="btn fda-bg text-white">
                    <i class="bi bi-plus-circle"></i>
                    report lost document
                </a>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered  data-table">
                            <thead class="text-capitalize text-sm">
                                <th>no</th>
                                <th>document details</th>
                                <th>owners details</th>
                                <th>status</th>
                                <th>date</th>
                                <th>more</th>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>
                                            @php
                                                echo $counter += 1;
                                            @endphp
                                        </td>
                                        <td>
                                            <ul class="list-group ms-3 h-100">
                                                <li class="list-group-item border-0  p-0 text-sm">
                                                    <b class="text-capitalize">type of document:</b>
                                                    {{ $document->documentType }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">serial number:</b>
                                                    {{ $document->serialNumber }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">institution on document:</b>
                                                    {{ $document->institution_on_document }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">police reference:</b>
                                                    {{ $document->police_ref_number }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">location lost:</b>
                                                    {{ $document->location }}
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
                                                    {{ $document->firstName }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">second name:</b>
                                                    {{ $document->lastName }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">email address:</b>
                                                    {{ $document->email }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize">phone number:</b>
                                                    {{ $document->code . $document->phoneNumber }}
                                                </li>
                                                <li class="list-group-item border-0 p-0 text-sm">
                                                    <b class="text-capitalize"> physical address:</b>
                                                    {{ $document->location }}
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            @if ($document->status === 0)
                                                <span class="badge rounded-pill  bg-danger">lost</span>
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
                                                        href="{{ route('correspondent.lostDocuments.edit', ['document_id' => $document->id]) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                        edit
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('correspondent.lostDocuments.view', ['document_id' => $document->id]) }}">
                                                        <i class="bi bi-eye"></i>
                                                        view
                                                    </a>
                                                    <form
                                                        action="{{ route('correspondent.lostDocuments.destroy', ['document_id' => $document->id]) }}"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
