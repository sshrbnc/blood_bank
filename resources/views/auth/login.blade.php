@extends('layouts.auth')

@section('content')

<div class="container-fluid" id="login_part">
    <div class="row no-gutters justify-content-center form_panel">
        <div class="col-md-3">
            <img id="login_bg" src="assets/img/login.jpg">
        </div>

        <div class="col-md-4">
            <form class="form-horizontal" id="formCont" role="form" method="POST" action="{{ url('login') }}">
                <div class="col-md-12 logo_panel">
                    <img id="logo" src="assets/img/prc_logo.png">
                </div>

                <div class="col-md-12" id="iprc_head">
                    Iloilo Blood Center
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                
                <div class="col-md-12 lg_det" id="adminUsername">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                </div>
               
                <div class="lg_det col-md-12 lg_det" id="adminPassword">
                    <input type="password" class="form-control" name="password" placeholder="Password">

                </div>
                <div class="col-md-12" id="forgotpw_note">
                    <a href="{{ route('auth.password.reset') }}">Forgot Password?</a>
                    <a href="#" style="color: red;">Contact Admin</a>
                </div>

                <div class="col-md-12" id="loginSubmit">
                    <button type="submit" class="btn btn-light text-bold" id="lg_submitbtn">
                        Log in                    
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection