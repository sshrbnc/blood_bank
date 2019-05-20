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
                    <a href="#" style="color: red;" data-toggle="modal" data-target="#sendEmail">Contact Admin</a>
                </div>

                <div class="col-md-12" id="loginSubmit">
                    <button type="submit" class="btn btn-light text-bold" id="lg_submitbtn">
                        Log in                    
                    </button>
                </div>

            </form>
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
