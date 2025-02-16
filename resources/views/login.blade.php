@extends('layouts.user')

@section('content')
    <div class="login-box">
        <div class="login-logo"> <b>e-Voting System</b> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Staff ID/Email" required>
                        <div class="input-group-text"> <span class="bi bi-person-fill"></span> </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div> <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"> <strong>Sign In</strong> </button>
                            </div>
                        </div><!-- /.col -->
                    </div> <!--end::Row-->
                </form>
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
@endsection
