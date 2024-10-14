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
                        <table class="table data-table">
                            <thead class="text-capitalize text-sm">
                                <th>callapse</th>
                                <th>no</th>
                                <th>owner's name</th>
                                <th>document type</th>
                                <th>serial number</th>
                                <th>found location</th>
                                <th>reported by</th>
                                <th>date and time reported</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($documents->where('status', 0) as $document)
                                    <tr class="border-none">
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
                                                echo $counter + 1;
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $document->owner_fname }} {{ $document->owner_lname }}
                                        </td>
                                        <td>
                                            {{ $document->typOfDocument }}
                                        </td>
                                        <td>
                                            {{ $document->serialNumber }}
                                        </td>
                                        <td>
                                            {{ $document->institution_on_document }}
                                        </td>
                                        <td>
                                            {{ $document->reporter_fname }} {{ $document->reporter_lname }}
                                        </td>
                                        <td>
                                            {{ $document->created_at->format('D, d M, Y H:i:s') }}
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
                                    <tr class="collapse border-0" id="collapseRow{{ $counter }}"
                                        style="border-top: 0ch;">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            country on
                                            <br>
                                            <b>{{ $document->countryName }}</b>
                                        </td>
                                        <td>
                                            city on
                                            <br>
                                            <b>{{ $document->city }}</b>
                                        </td>
                                        <td></td>
                                        <td>
                                            Reporter's Phone number
                                            <br>
                                            <b>
                                                {{ $document->reporter_code . $document->reporter_phoneNumber }}
                                            </b>
                                        </td>
                                        <td>
                                            Reporter's email
                                            <br>
                                            <b>
                                                {{ $document->reprter_email }}
                                            </b>
                                        </td>
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
