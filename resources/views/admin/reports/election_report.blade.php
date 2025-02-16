@extends('layouts.app')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->

        <x-admin_breadcrumb :header="'Election Outcome'" />

        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Report @isset($votes)- {{ $votes[0]->election_name }} @endisset</h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm float-end">
                                <li class="page-item">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Select Election" data-bs-url="form_create/viewReport" data-bs-size="">Generate Report</button> {{-- modal-lg --}}
                                </li>
                            </ul>
                        </div>
                    </div> <!-- /.card-header -->
{{--                    {{ dd($votes->where('voting_position_id', 3), $voting_positions) }}--}}
                    @isset($votes)
                        <div class="card-body p-0">
                            @forelse($voting_positions as $position)
                                @php
                                    $count = 1;
                                @endphp
                                <table class="table">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th colspan="50">{{ $position->position_name }}</th>
                                        </tr>
                                        <tr class="table-secondary">
                                            <th style="width: 5%"><strong>#</strong></th>
                                            <th style="width: 50%">Candidate</th>
                                            <th style="width: 25%">Position</th>
                                            <th style="width: 10%">Votes</th>
                                            <th style="width: 10%">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($votes->where('voting_position_id', $position->id) as $vote)
                                            <tr class="align-middle">
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $vote->candidate_name }}</td>
                                                <td>{{ $vote->position_name }}</td>
                                                <td>{{ $vote->votes }}</td>
                                                <td>{{ $vote->votes }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="50">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @empty
                                <tr>
                                    <td colspan="50">No Data Found</td>
                                </tr>
                            @endforelse
                        </div> <!-- /.card-body -->
                    @endisset
                </div> <!-- /.card -->
                <a href="print_election_report/{{ $votes[0]->election_id }}" class="btn btn-primary float-end"> <i class="bi bi-printer-fill"></i> Printer</a>
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main> <!--end::App Main--> <!--begin::Footer-->

    <x-call-modal />
@endsection



