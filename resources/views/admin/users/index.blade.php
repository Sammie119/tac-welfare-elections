@extends('layouts.app')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->

        <x-admin_breadcrumb :header="'Users'" />

        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <x-notifications :messages="Session::get('error')" :type="0"/>

                <x-notifications :messages="Session::get('success')" :type="1"/>

                <x-notifications :messages="$errors->all()"/>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Users List</h3>
                        <div class="card-tools">
{{--                            <button class="btn btn-sm btn-primary float-end">Add New</button>--}}
{{--                            <a class="btn btn-sm btn-primary">Add New</a>--}}
                            <ul class="pagination pagination-sm float-end">
                                <li class="page-item">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New User" data-bs-url="form_create/createUser" data-bs-size="modal-lg">Add New</button> {{-- modal-lg --}}
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
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th style="width: 170px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                    <tr class="align-middle">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->is_admin === 1) ? "Admin" : "User" }}</td>
                                        <td>
{{--                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View User Detail - {{ $user->name }}" data-bs-url="form_view/viewUser/{{ $user->id }}" data-bs-size="modal-lg"> Details</button>--}}
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit User Details" data-bs-url="form_edit/editUser/{{ $user->id }}" data-bs-size="modal-lg"> <i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Deletion" data-bs-url="form_delete/deleteUser/{{ $user->id }}" data-bs-size=""> <i class="bi bi-trash"></i></button>
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



