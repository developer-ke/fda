@php
    $note = 'Partners';
    $counter = 1;
@endphp
@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.partner.create') }}" class="btn text-white fda-bg">
                <span class="bi bi-plus-circle"></span>
                new
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-light table-bordered table-striped data-table">
                    <thead class="text-capitalizee">
                        <th>No</th>
                        <th>added by</th>
                        <th>logo</th>
                        <th>status</th>
                        <th>added on</th>
                        <th>actions</th>
                    </thead>
                    <tbody>

                        @foreach ($partners as $partner)
                            <tr>
                                <td>
                                    @php
                                        echo $counter++;
                                    @endphp
                                </td>
                                <td class="mx-auto">
                                    {{ $partner->name }}
                                </td>
                                <td>
                                    <div class="container mx-auto">
                                        <img src="{{ asset('assets/cms/' . $partner->logo) }}" alt="{{ $partner->logo }}"
                                            class="image-fluid rounded-3 mx-auto" width="200px" height="150px">
                                    </div>
                                </td>
                                <td>
                                    @if ($partner->status)
                                        <span class="badge badge-rounded-pill bg-success">enabled</span>
                                    @else
                                        <span class="badge badge-rounded-pill bg-danger">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $partner->created_at->format('D, d M, Y') }}
                                </td>
                                <td>
                                    <div class="dropdown open">
                                        <button class="btn" type="button" id="triggerId" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="bi bi-three-dots-vertical bold"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end text-capitalize"
                                            aria-labelledby="triggerId">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.partner.edit', ['partner_id' => $partner->id]) }}">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('admin.partner.enable', ['partner_id' => $partner->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="dropdown-item text-capitalize  @if ($partner->status) d-none @endif"
                                                    onclick="return confirm('Are you sure you want to  enable this partnership?')">
                                                    <span class="bi bi-check-circle"></span>
                                                    Enable
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('admin.partner.disable', ['partner_id' => $partner->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="dropdown-item text-capitalize  @if (!$partner->status) d-none @endif"
                                                    onclick="return confirm('Are you sure you want to  disable this partnership?')">
                                                    <span class="bi bi-x-circle"></span>
                                                    Disable
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('admin.partner.destroy', ['partner_id' => $partner->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-capitalize"
                                                    onclick="return confirm('Are you sure you want to delete this partnership?')">
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
@endsection
