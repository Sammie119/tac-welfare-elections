@extends('layouts.app')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->

        <x-admin_breadcrumb :header="'Election Outcome'" />

        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Report</h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm float-end">
                                <li class="page-item">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Select Election" data-bs-url="form_create/viewReport" data-bs-size="">Generate Report</button> {{-- modal-lg --}}
                                </li>
                            </ul>
                        </div>
                    </div> <!-- /.card-header -->
                    @isset($votes)
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">#</th>
                                        <th>Name</th>
                                        <th>Candidate</th>
                                        <th>Position</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($votes as $key => $vote)
                                        <tr class="align-middle">
                                            <td>{{ ++$key }}</td>
                                            <td>{{ \App\Models\Voter::find($vote->voter_id)->name }}</td>
                                            <td>{{ \App\Models\Candidate::find($vote->candidate_id)->name }}</td>
                                            <td>{{ \App\Models\VotingPosition::find($vote->voting_position_id)->position_name }}</td>
                                            <td>{{ $vote->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="50">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    @endisset
                </div> <!-- /.card -->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main> <!--end::App Main--> <!--begin::Footer-->

    <x-call-modal />
@endsection



