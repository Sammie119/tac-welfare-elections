@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.user')

@section('content')
    <div class="app-wrapper"> <!--begin::Header-->
        <div class="row">
            <div class="col-12">
                <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Start Navbar Links-->
                        <ul class="navbar-nav">
                            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="/dashboard" role="button"> <i class="bi bi-list"></i> </a> </li>
                            <li class="nav-item d-none d-md-block"> <a href="/dashboard" class="nav-link">Home</a> </li>
                            <!-- <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li> -->
                        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">  <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" > <!--begin::User Image-->
                                    <li class="user-footer">
{{--                                        <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                                        <a href="{{ route('user_logout') }}" class="btn btn-default btn-flat float-end">{{ __('Log Out') }}</a>
                                    </li> <!--end::Menu Footer-->
                                </ul>
                            </li> <!--end::User Menu Dropdown-->
                        </ul> <!--end::End Navbar Links-->
                    </div> <!--end::Container-->
                </nav> <!--end::Header-->
            </div>
            <div class="col-12">
                <div class="app-content">
                    <div class="mt-3 mb-3">
                        <h1>Election: {{ $election->name }}</h1>
                        <h1>Status: {{ ($election->status === 0) ? "Voting Starts on $election->start_date on $election->start_time" : "Voting is on going, it end at $election->end_time" }}</h1>
                    </div>
                    <x-notifications :messages="Session::get('error')" :type="0"/>

                    <x-notifications :messages="Session::get('success')" :type="1"/>

                    <x-notifications :messages="$errors->all()"/>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Voting Positions List</h3>
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
                                @if($election->status === 0)
                                    <tr>
                                        <td colspan="3">Voting has not Started</td>
                                    </tr>

                                @else
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">#</th>
                                            <th>Position Name</th>
                                            <th style="width: 170px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ballots as $key => $ballot)
                                            @php
                                                $election = \App\Models\ElectionSettings::find($ballot->election_id);
                                                $voter = \App\Models\Voter::where('voters_id', Auth::user()->email)->first();
                                                $check_if_voted = \App\Models\Vote::where(['election_id' => $ballot->election_id, 'voter_id' => $voter->id, 'voting_position_id' => $ballot->id])->get('id');
                                            @endphp
                                            <tr class="align-middle">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $ballot->position_name }}</td>
                                                <td>
                                                    @if(count($check_if_voted) >= 1)
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Your Vote" data-bs-url="form_view/castedVoted/{{ $check_if_voted[0]->id }}" data-bs-size="modal-lg"> View your Vote</button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Voting Position - {{ $ballot->position_name }}" data-bs-url="form_view/castingVote/{{ $ballot->id }}" data-bs-size="modal-lg"> Vote</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="50">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
            </div>
        </div>
    </div>

    <x-call-modal />
@endsection
