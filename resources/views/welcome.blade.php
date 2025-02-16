@extends('layouts.user')

<style>
    .v_buttons {
        width: 200px;
        height: 250px;
    }
</style>

@section('content')
    <div class="text-center" style="font-weight: bolder">
        <p class="fs-1">TAC-GH Non-Ministerial Support Staff</p>
        <p class="fs-3">e-Voting System</p>
    </div>

    <x-notifications :messages="$errors->get('email')"/>

    <div class="d-grid gap-2 d-md-block">
        <button class="btn btn-outline-primary btn-lg v_buttons" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Voters Register" data-bs-url="form_create/viewVotersRegister" data-bs-size="modal-xl">
            <strong>Voters Register</strong>
        </button>

        <button class="btn btn-outline-primary btn-lg v_buttons" type="button" style="margin-left: 20px" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Voter Login" data-bs-url="form_create/voteLoginPage" data-bs-size="modal-sm">
            <strong>Cast Vote</strong>
        </button>
    </div>

    <x-call-modal />
@endsection
