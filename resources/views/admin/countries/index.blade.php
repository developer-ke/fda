@php
    $note = 'countries';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <a href="{{ route('admin.countries.create') }}" class="btn fda-bg text-white">
                        <i class="fa fa-plus-circle"></i>
                        add
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-hover mb-0 data-table">
                            <thead class="text-uppercase text-sm text-start">
                                <th>no</th>
                                <th>country</th>
                                <th>government</th>
                                <th>capital city</th>
                                <th>nationality</th>
                                <th>abbreviation</th>
                                <th>code</th>
                                <th>added by</th>
                                <th>added on</th>
                                <th class="text-center">action</th>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>
                                            @php
                                                echo $counter;
                                            @endphp
                                        </td>
                                        <td class="align-middle text-sm text-capitalize">
                                            {{ $country->countryName }}
                                        </td>
                                        <td class="align-middle text-sm text-capitalize">
                                            Government of {{ $country->countryName }}
                                        </td>
                                        <td class="align-middle text-sm text-capitalize">
                                            {{ $country->city }}
                                        </td>
                                        <td class="align-middle  text-sm text-capitalize">
                                            {{ $country->nationality }}
                                        </td>
                                        <td class="align-middle text-center text-capitalize">
                                            {{ $country->abbreviation }}
                                        </td>
                                        <td class="align-middle text-center text-capitalize">
                                            {{ $country->code }}
                                        </td>
                                        <td>
                                            {{ $country->name }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $country->created_at->format('D, d M, Y') }}

                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a type="button"
                                                    href="{{ route('admin.countries.edit', ['countryId' => $country->id]) }}"
                                                    class="btn">
                                                    <span class="bi bi-pencil-square text-secondary"></span>
                                                </a>
                                                <a type="button" class="btn text-secondary"
                                                    onclick="viewCountry(
                                                                '{{ $country->countryName }}',
                                                                '{{ $country->abbreviation }}',
                                                                '{{ $country->nationality }}',
                                                                '{{ $country->code }}',
                                                                '{{ $country->created_at }}'
                                                            )">
                                                    <i class="fa fa-eye text-secondary"></i>

                                                </a>
                                                <button class="btn text-danger" type="submit"
                                                    onclick="deleteCountry({{ $country->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
    </div>
    @push('scripts')
        <script>
            const viewCountry = (countryName, abbreviation, nationality, code, created_at) => {
                var date = new Date(created_at);
                document.querySelector('.countryName').innerText = countryName;
                document.querySelector('.nationality').innerText = nationality;
                document.querySelector('.countryCode').innerText = code;
                document.querySelector('.abbreviation').innerText = abbreviation;
                document.querySelector('.createdAt').innerText = date.getDate() + '/' + date.getMonth() + '/' + date
                    .getFullYear();
                $('#viewCountryModal').modal('show');
            }

            // delete function
            const deleteFunction = async (url) => {
                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    });

                    const data = await response.json();
                    if (response.ok) {
                        alertSuccess('Success', data.message);
                        window.location.reload();
                    } else {
                        alertError('Error', data.message || 'An error occurred while deleting the country.');
                    }
                } catch (error) {
                    console.error(error);
                    alertError('Error', 'An unexpected error occurred.');
                }
            };

            const deleteCountry = (id) => {
                alertDelete(() => deleteFunction(`/admin/countries/${id}/delete`));
            };
        </script>
    @endpush
@endsection
