@extends('layouts.app')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->

        <x-admin_breadcrumb :header="'Ballot Positioning'" />

        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <x-notifications :messages="Session::get('error')" :type="0"/>

                <x-notifications :messages="Session::get('success')" :type="1"/>

                <x-notifications :messages="$errors->all()"/>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Voting Position List</h3>
                        <div class="card-tools">
{{--                            <button class="btn btn-sm btn-primary float-end">Add New</button>--}}
{{--                            <a class="btn btn-sm btn-primary">Add New</a>--}}
                            <ul class="pagination pagination-sm float-end">
                                <li class="page-item">
{{--                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New User" data-bs-url="form_create/createUser" data-bs-size="modal-lg">Add New</button> --}}{{-- modal-lg --}}
                                </li>
                            </ul>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 20px">#</th>
                                <th>Position Name</th>
                                <th>Election</th>
                                <th>Status</th>
                                <th style="width: 170px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ballots as $key => $ballot)
                                @php
                                    $election = \App\Models\ElectionSettings::find($ballot->election_id);
                                @endphp
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $ballot->position_name }}</td>
                                    <td>{{ $election->name }}</td>
                                    <td>{!! getStatus($election->status) !!}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Set Ballot Position - {{ $ballot->position_name }}" data-bs-url="form_view/viewBallot/{{ $ballot->id }}" data-bs-size="modal-lg"> Position</button>
{{--                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Election Details" data-bs-url="form_edit/editElection/{{ $election->id }}" data-bs-size="modal-lg"> <i class="bi bi-pencil-square"></i></button>--}}
{{--                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Material Deletion" data-bs-url="form_delete/deleteElection/{{ $election->id }}" data-bs-size=""> <i class="bi bi-trash"></i></button>--}}
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



