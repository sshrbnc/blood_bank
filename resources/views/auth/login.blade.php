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
                    <!-- @if (count($errors) > 0)
                        <div class="alert alert-danger login_validation">
                            <strong>Invalid Usernamer or Password</strong>
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                    <form class="form-horizontal" id="formCont" role="form" method="POST" action="{{ url('login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                            <div class="col-md-12" id="adminUsername">
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                <p></p>
                                <span id="emailMsg" name="emailMsg" style="font-size: 13px;"></span>                                
                            </div>
                            <div class="col-md-12" id="adminPassword">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                <span id="passwordMsg" name="passwordMsg"></span>                                
                            </div>

                            <div class="form-group">
                                <div class="col-md-10" style="font-size: 14px; margin-left: 30px; margin-top: 20px;">
                                    <a href="{{ route('auth.password.reset') }}">Forgot Password?</a>
                                    <a href="#" style="color: red;" data-toggle="modal" data-target="#sendEmail">Contact Admin</a>
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
                            {{ csrf_field() }}
                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ url('sendemail/send') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Provide reason"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <!-- <input type="submit" name="send" value="Send" class="btn btn-info" style="background-color: #026C76; border: none;"> -->
                                <button type="submit" name="send" style="background-color: #026C76; border: none;" class="btn btn-primary">Send</button>                                 
                            </div>
                        </div>                            
                    </div>
                </form>
            </div>
        </div>
    </div>

@include('partials.footer')
@endsection

@section('javascript') 
    <!-- <script type="text/javascript" src="../assets/js/formValidation.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function(){

            $('#email').blur(function(){
                var error_email = '';
                var email = $('#email').val();
                var _token = $('input[name="_token"]').val();
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!filter.test(email)){    
                    $('#emailMsg').html('<label class="text-danger">Invalid Email</label>');
                    $('#email').addClass('has-error');
                    $('#loginSubmit').attr('disabled', 'disabled');
                }else{
                    $.ajax({
                        url:"{{ route('login.check') }}",
                        method:"POST",
                        data:{email:email, _token:_token},
                        success:function(result){
                            if(result == 'unique'){
                                $('#emailMsg').html('<label class="text-success">Email Available</label>');
                                $('#email').removeClass('has-error');
                                $('#loginSubmit').attr('disabled', false);
                            }else{
                                $('#emailMsg').html('<label class="text-danger">Email not Available</label>');
                                $('#email').addClass('has-error');
                                $('#loginSubmit').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            });

            // console.log('login ready');
            // $('#email').on('input',function() {
            //     console.log("input email");
            //     var email = $(this);
            //     var emailReg = new RegExp("^[^@\s]+@[^@\s]+\.[^@\s]+$");
            //     valid = emailReg.test(email.val());

            //     if(valid==true){
            //         $('#emailMsg').text("");
            //         // $('#emailMsg').addClass('valid');
            //     }
            //     else{
            //         $('#emailMsg').text("Email is invalid.");
            //         // $('#emailMsg').removeClass('valid').addClass('invalid');
            //     }
            // });

            // $('#formCont').submit(function(event){
            //     var error = 0;
            //     if ($('#email').val()== ""){
            //         $('#emailMsg').text("Input Email");
            //         error++;
            //     }
                
            //     if (error == 0){
            //         // alert("SUCCESSFUL");
            //         $('#formCont').reset();
            //         $('span').text("");
            //     }
            //     console.log(error);
            //     event.preventDefault();
            // });
        });
    </script>

@endsection