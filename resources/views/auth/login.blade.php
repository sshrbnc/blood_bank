@extends('layouts.auth')

@section('content')
    <div class="row" id="loginHeader">
    <div class="col-md-12">
        <h1 class="title"><img class="prc_logo" src="assets/img/prc_logo.png">&nbsp; Philippine Red Cross - Iloilo Chapter</h1>
    </div>
    </div>
    <div class="row">
        <div class="col-md-8"><img src="assets/img/pic2.jpg" style="margin-left: 50px; margin-top: 100px;"></div>
        <div class="col-md-4" >
            <div class="panel panel-default" id="loginPanel">
                <!-- <div class="panel-heading text-center text-bold" >{{ ucfirst(config('app.name')) }} @lang('quickadmin.qa_login')</div> -->
                <div class="panel-body">                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger login_validation">
                            <strong>Invalid Usernamer or Password</strong>
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" id="formCont" role="form" method="POST" action="{{ url('login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                            <div class="col-md-12" id="adminUsername">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                            <div class="col-md-12" id="adminPassword">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <div class="col-md-10" style="font-size: 14px; margin-left: 30px; margin-top: 20px;">
                                    <a href="{{ route('auth.password.reset') }}">Forgot Password?</a>
                                    <a href="#" style="color: red;">Contact Admin</a>
                                </div>
                            </div>


                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <label style="color: #ffffff">
                                    <input type="checkbox" 
                                           name="remember"> @lang('quickadmin.qa_remember_me')
                                </label>
                            </div>
                        </div> -->

                       <!--  <div class="form-group"> -->
                            <button type="submit" class="btn btn-light text-bold col-md-12 formContents" id="loginSubmit">
                                Log in
                            </button>
                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('partials.footer')
@endsection