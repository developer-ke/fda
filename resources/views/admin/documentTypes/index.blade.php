@php
    $note = 'document types';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="mt-2">
        <div class="card shadow-none">
            <div class="card-header">
                <a href="{{ route('admin.documentTypes.create') }}" class="btn fda-bg text-white">
                    <i class="bi bi-plus-circle"></i>
                    new
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 table-hover data-table">
                        <thead class="text-uppercase text-sm text-start">
                            <th>no</th>
                            <th>added by</th>
                            <th>document type</th>
                            <th>date added</th>
                            <th>actions</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($documents as $document)
                                <tr>
                                    <td>
                                        @php
                                            echo $counter;
                                        @endphp
                                    </td>
                                    <td>
                                        {{ $document->username }}
                                    </td>
                                    <td class="text-capitalize">{{ $document->name }}</td>
                                    <td class="text-capitalize">
                                        {{ $document->created_at->format('D, d M, Y') }}
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
                                                    href="{{ route('admin.documentTypes.edit', ['document_id' => $document->id]) }}">
                                                    <i class="fa fa-pencil-square"></i>
                                                    edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.documentTypes.delete', ['document_id' => $document->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-capitalize"
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
