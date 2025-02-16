@extends('layouts.app')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->

        <x-admin_breadcrumb :header="'Voters'" />

        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <x-notifications :messages="Session::get('error')" :type="0"/>

                <x-notifications :messages="Session::get('success')" :type="1"/>

                <x-notifications :messages="$errors->all()"/>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Voters List</h3>
                        <div class="card-tools">
{{--                            <button class="btn btn-sm btn-primary float-end">Add New</button>--}}
{{--                            <a class="btn btn-sm btn-primary">Add New</a>--}}
                            <ul class="pagination pagination-sm float-end">
                                <li class="page-item">
                                    <a class="btn btn-sm btn-info" href="{{ asset('file_download/voters_upload_file.xlsx') }}">Export</a> {{-- modal-lg --}}
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Voter" data-bs-url="form_create/createVoter" data-bs-size="modal-lg">Add New</button> {{-- modal-lg --}}
                                </li>
                            </ul>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th>Name</th>
                                    <th>Voter ID</th>
                                    <th>Code</th>
                                    <th>Mobile</th>
                                    <th>Election</th>
                                    <th>Status</th>
                                    <th style="width: 170px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($voters as $key => $voter)
                                    <tr class="align-middle">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $voter->name }}</td>
                                        <td>{{ $voter->voters_id }}</td>
                                        <td>{{ $voter->code }}</td>
                                        <td>{{ $voter->mobile_number }}</td>
                                        <td>{{ getElectionName($voter->election_id) }}</td>
                                        <td>{!! getStatus(\App\Models\ElectionSettings::find($voter->election_id)->status) !!}</td>
                                        <td>
{{--                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Voter Detail - {{ $voter->name }}" data-bs-url="form_view/viewVoter/{{ $voter->id }}" data-bs-size="modal-lg"> Details</button>--}}
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Voter Details" data-bs-url="form_edit/editVoter/{{ $voter->id }}" data-bs-size="modal-lg"> <i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Deletion" data-bs-url="form_delete/deleteVoter/{{ $voter->id }}" data-bs-size=""> <i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main> <!--end::App Main--> <!--begin::Footer-->

    <x-call-modal />
@endsection



