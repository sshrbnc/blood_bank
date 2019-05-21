@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Patients</h3>
    @can('patient_create')
    <p>
    <button 
        type="button" 
        class="btn btn-primary" 
        data-toggle="modal"
        data-target="#newPatientModal">
        <i class="fas fa-user-plus"></i> Add New
    </button>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            Patients
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-striped display compact {{ count($patients) > 0 ? 'datatable' : '' }}" id="patients_list"
            data-toggle="dataTable" data-form="deleteForm">
                <thead>
                    <tr>
                        @can('patient_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Name</th>
                        <th>Blood Type</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>Contact Number</th>
                        <th>Remarks</th>

                        @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                        @else
                            <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                @if (count($patients) > 0)
                    @foreach($patients as $value)
                    <tr>
                        @can('patient_delete')    
                                @if ( request('show_deleted') != 1 )<td></td>@endif
                        @endcan
                        <td>{{$value['firstname']}} {{$value['middlename']}} {{$value['lastname']}}</td>
                        <td>{{$value['blood_type']}}</td>
                        <td>{{$value['address']}}</td>
                        <td>{{$value['birthday']}}</td>
                        <td>{{$value['age']}}</td>
                        <td>+{{$value['contact_number']}}</td>
                        <td>{{$value['details_information']}}</td>
                        <div id="options">
                            <td><a href="{{ route('admin.patients.show',$value['id']) }}" class="btn btn-xs btn-primary opt_button">View</a>
                            @can('patient_delete')
                                {!! Form::model($value, ['method' => 'delete', 'route' => ['admin.patients.destroy', $value['id']], 'class' =>'form-inline form-delete opt_button']) !!}
                                {!! Form::hidden('id', $value['id']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                {!! Form::close() !!}
                            @endcan
                            </td>  
                        </div>
                        
                    </tr>
                    @endforeach  

                @else
                    <tr>
                        <td colspan="15">No Patients Listed</td>
                    </tr>

                @endif  
                    
                </tbody>      
            </table>
        </div>
    </div>

<!-- modal for delete -->
    <div class="modal" id="confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you, want to delete the patient's records?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- end of modal -->


<!-- modal for create -->
<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="favoritesModalLabel">Add new patient</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'id' => 'addNewPatient', 'route' => ['admin.patients.store']]) !!}
                {{form::token()}}
                <div class="form-group row">
                    {{form::label('firstname', 'First Name:', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::text('firstname', '', ['class' => 'col-md-5 input_field form-control', 'placeholder' => '', 'id'=> 'fname'])}}
                    <span class="col-md-3" id="fnameErrorMsg"></span>

                    @if($errors->has('firstname'))
                        <p class="help-block">
                            {{ $errors->first('firstname') }}
                        </p>
                    @endif
                </div>  
                    
                 <div class="form-group row">
                    {{form::label('middlename', 'Middle Name:', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::text('middlename', '', ['class' => 'col-md-5 input_field form-control', 'placeholder' => '', 'id'=>'mname'])}}
                    <span class="col-md-3" id="mnameErrorMsg"></span>

                    @if($errors->has('middlename'))
                        <p class="help-block">
                            {{ $errors->first('middlename') }}
                        </p>
                    @endif
                </div>

                 <div class="form-group row">
                    {{form::label('lastname', 'Last Name:', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::text('lastname', '', ['class' => 'col-md-5 input_field form-control', 'placeholder' => '', 'id'=>'lname'])}}
                    <span class="col-md-3" id="lnameErrorMsg"></span>
                </div>

                <div class="form-group row">
                    {{form::label('blood_type', 'Blood Type:', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::select('blood_type', array('default'=>'','A+' => 'A+', 'AB+' => 'AB+','B+' => 'B+','O+' => 'O+','A-' => 'A-', 'AB-' => 'AB-','B-' => 'B-','O-' => 'O-'), '', ['class' => 'col-md-5 input_field form-control', 'id'=>'btype'])}}
                    <span class="col-md-3" id="btypeErrorMsg"></span>
                    
                    @if($errors->has('blood_type'))
                        <p class="help-block">
                            {{ $errors->first('blood_type') }}
                        </p>
                    @endif

                </div>


                <div class="form-group row">
                    {{form::label('address','Address:', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::text('address', '', ['class' => 'col-md-10 input_field form-control', 'placeholder' => '', 'id'=>'address'])}}
                    <span class="col-md-3" id="addressErrorMsg"></span>

                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>


                <div class="form-group row">
                    {{form::label('birthday', 'Birthday:', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::text('birthday', '', ['class' => 'col-md-5 input_field form-control date', 'placeholder' => '', 'id'=>'bdate'])}}
                    <span class="col-md-3" id="bdayErrorMsg"></span>
                    
                    @if($errors->has('birthday'))
                        <p class="help-block">
                            {{ $errors->first('birthday') }}
                        </p>
                    @endif
                </div>

                <div class="form-group row">
                    {{form::label('contact_number', 'Contact Number: (+639)', ['class' => 'col-md-4 label_name control-label'])}}
                    {{form::text('contact_number', '', ['class' => 'col-md-5 input_field form-control', 'placeholder' => '', 'id'=>'contactNum'])}}
                    <span class="col-md-3" id="contactErrorMsg"></span>

                    @if($errors->has('contact_number'))
                        <p class="help-block">
                                     {{ $errors->first('contact_number') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('details_information', 'Details Information:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('details_information', old('details_information'), ['class' => 'form-control editor', 'placeholder' => 'Remarks', 'style' => 'height: 100px;']) !!}
                            
                    @if($errors->has('details_information'))
                        <p class="help-block">
                            {{ $errors->first('details_information') }}
                        </p>
                    @endif        
                </div>
            </div>

            <div class="modal-footer">
                {{Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'savePatient'])}}
                <button type="button" id="cancelForm" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>      
</div>
<!-- \\\\\\\\\\\\\\\\\\\end of modal\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

<!-- \\\\\\\\\\\\\\for sms\\\\\\\\\\\\\ -->
<!-- <form action="{{url('sms')}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
       <label for="mobile">Mobile Number</label>
        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile Number">
    </div>

    <button type="submit" class="btn btn-primary">
        Send SMS        
    </button>
</form> 
 -->
@stop



@section('javascript') 
    <script type="text/javascript">
        @can('patient_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.patients.mass_destroy') }}'; @endif
        @endcan
    </script>

    <script>
        $(document).ready(function(){
            $(function(){
                $('#bdate').datepicker({
                    dateFormat : 'yy-mm-dd',
                    changeMonth : true,
                    changeYear : true,
                    yearRange: '-100y:c+nn',
                    maxDate: '-1d'
                });  
            });
                     

            $("#savePatient").on('click', function(){
                console.log("patient_saved");
            });

            $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
                e.preventDefault();
                var $form=$(this);
                $('#confirm').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                        $form.submit();
                });
            });


            // validation
            $("#addNewPatient").submit(function(event){
                checkFname();
                checkMname();
                checkLname();
                checkAddress();
                checkBtype();
                checkBdate();
                checkEmptyContact();

                if($("span").hasClass("invalid")){
                    event.preventDefault();
                }
            });

            function checkFname(){
                if ($("#fname").val() ===""){
                    $("#fnameErrorMsg").text("Required field");
                    $("#fnameErrorMsg").removeClass("valid").addClass("invalid");
                }
                else if ($("#fname").val() !=""){
                    $("#fnameErrorMsg").text("");
                    $("#fnameErrorMsg").removeClass("invalid").addClass("valid");
                }  
            }

            function checkLname(){
                if ($("#lname").val()===""){
                    $("#lnameErrorMsg").text("Required field");
                    $("#lnameErrorMsg").removeClass("valid").addClass("invalid");
                }
                else if ($("#lname").val() !=""){
                    $("#lnameErrorMsg").text("");
                    $("#lnameErrorMsg").removeClass("invalid").addClass("valid");
                }   
            }

            function checkMname(){
                if($("#mname").val()===""){
                    $("#mnameErrorMsg").text("Required field");
                    $("#mnameErrorMsg").removeClass("valid").addClass("invalid");

                }
                else if ($("#mname").val() !=""){
                    $("#mnameErrorMsg").text("");
                    $("#mnameErrorMsg").removeClass("invalid").addClass("valid");
                }   
            }

            function checkAddress(){
                if ($("#address").val()==="") {
                    $("#addressErrorMsg").text("Required field");
                    $("#addressErrorMsg").removeClass("valid").addClass("invalid");
                    console.log('no adress found');
                }
                else if ($("#address").val() !=""){
                    $("#addressErrorMsg").text("");
                    $("#addressErrorMsg").removeClass("invalid").addClass("valid");
                }
            }

            function checkBdate(){
                 if ($("#bdate").datepicker("getDate")=== null) {
                    console.log('no bday');
                    $("#bdayErrorMsg").text("Required field");
                    $("#bdayErrorMsg").removeClass("valid").addClass("invalid");
                }
                else{
                    $("#bdayErrorMsg").text("");
                    $("#bdayErrorMsg").removeClass("invalid").addClass("valid");
                }
            }

            function checkBtype(){
                 if ($("#btype").val()==="default"){
                    console.log("la btype");
                    $("#btypeErrorMsg").text("Required field");
                    $("#btypeErrorMsg").removeClass("valid").addClass("invalid");
                }
                else  if ($("#btype").val()!="default"){
                     $("#btypeErrorMsg").text("");
                     $("#btypeErrorMsg").removeClass("invalid").addClass("valid");
                }
            }

            $("#fname").on('input', checkFname);

            $("#mname").on('input', checkMname);

            $("#lname").on('input', checkLname);

            $("#address").on('input', checkAddress);

            $("#bdate").on('input', checkBdate);    

            $('#btype').on('change', checkBtype);
            
           
            $('#contactNum').on('input', function(){
                var inputNum = $(this);
                var numPat = new RegExp("^[0-9]{9}$");
                var validNum = numPat.test(inputNum.val());

                if(validNum){
                    $("#contactErrorMsg").text("Number is valid");
                    $("#contactErrorMsg").removeClass("invalid").addClass("valid");
                }
                else{
                    $("#contactErrorMsg").text("Number is invalid");
                    $("#contactErrorMsg").removeClass("valid").addClass("invalid");
                } 
            });

            function checkEmptyContact(){
                if($("#contactNum").val()===""){
                    $("#contactErrorMsg").text("Required field");
                    $("#contactErrorMsg").removeClass("valid").addClass("invalid");
 
               }
            }            
        });
    </script>
@endsection