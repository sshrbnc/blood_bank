@extends('layouts.auth')

@section('content')
    <div class="row">
    <div class="col-md-12" id="loginHeader">
        <h1 class="title">Philippine Red Cross - Iloilo Chapter</h1>
    </div>
    </div>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4" >
            <div class="panel panel-default" id="loginPanel">
                <!-- <div class="panel-heading text-center text-bold" >{{ ucfirst(config('app.name')) }} @lang('quickadmin.qa_login')</div> -->
                <div class="panel-body">
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>@lang('quickadmin.qa_whoops')</strong> @lang('quickadmin.qa_there_were_problems_with_input'):
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" id="formCont" 
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
 
                            <div class="col-md-12" id="adminUsername">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email') }}"
                                placeholder="Username">
                            </div>


                            <div class="col-md-12" id="adminPassword">
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                placeholder="Password">
                            </div>

                       <!--  <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a href="{{ route('auth.password.reset') }}">@lang('quickadmin.qa_forgot_password')</a>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <label style="color: #ffffff">
                                    <input type="checkbox" 
                                           name="remember"> @lang('quickadmin.qa_remember_me')
                                </label>
                            </div>
                        </div> -->

                       <!--  <div class="form-group"> -->
                                <button type="submit" class="btn btn-light text-bold col-md-12" id="loginSubmit">
                                    Log in
                                   <!--  @lang('quickadmin.qa_login') -->
                                </button>
                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('partials.footer')
@endsection