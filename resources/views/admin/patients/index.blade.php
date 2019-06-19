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
        data-target="#newPatientModal" style="background-color: #026C76; border: none;"> 
        <i class="fas fa-plus"></i> Add New
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

                    <!-- edit patient modal -->
                     <div class="modal fade" id="editPatientModal-{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 40%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

                                    <h4 class="modal-title" id="favoritesModalLabel">Edit Patient Record</h4>
                                </div>
                                <div class="modal-body" style="padding-top: 0px;">
                                {!! Form::model($value, ['method' => 'PUT', 'route' => ['admin.patients.update', $value['id']], 'files' => true,]) !!}

                                    {{form::token()}}


                                    <div class="panel-body">
                                        <div class="form-group row">
                                                {!! Form::label('blood_type', 'Blood Type', ['class' => 'col-md-4 label_name control-label']) !!}
                                                <div>
                                                    {!! Form::select('blood_type', array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'), old('blood_type'), array('style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control')) !!}  
                                                </div>
                                                <p class="help-block"></p>
                                                @if($errors->has('blood_type'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('blood_type') }}
                                                    </p>
                                                @endif          
                                        </div>
                                        <div class="form-group row">
                                                {!! Form::label('firstname', 'First Name', ['class' => 'col-md-4 label_name control-label']) !!}
                                                {!! Form::text('firstname', old('firstname'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control', 'placeholder' => 'First Name', 'required' => '']) !!}
                                                <p class="help-block"></p>
                                                @if($errors->has('firstname'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('firstname') }}
                                                    </p>
                                                @endif
                                        </div>
                                        <div class="form-group row">
                                                {!! Form::label('middlename', 'Middle Name', ['class' => 'col-md-4 label_name control-label']) !!}
                                                {!! Form::text('middlename', old('middlename'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control', 'placeholder' => 'Middle Name', 'required' => '']) !!}
                                                <p class="help-block"></p>
                                                @if($errors->has('middlename'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('middlename') }}
                                                    </p>
                                                @endif
                                        </div>
                                        <div class="form-group row">
                                                {!! Form::label('lastname', 'Last Name', ['class' => 'col-md-4 label_name control-label']) !!}
                                                {!! Form::text('lastname', old('lastname'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control', 'placeholder' => 'Last Name', 'required' => '']) !!}
                                                <p class="help-block"></p>
                                                @if($errors->has('lastname'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('lastname') }}
                                                    </p>
                                                @endif                                    
                                        </div>         
                                        <div class="form-group row">
                                                {!! Form::label('birthday', 'Birthday', ['class' => 'col-md-4 label_name control-label']) !!}
                                                {!! Form::text('birthday', old('birthday'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control date', 'placeholder' => 'Birthday', 'required' => '']) !!}
                                                <p class="help-block"></p>
                                                @if($errors->has('birthday'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('birthday') }}
                                                    </p>
                                                @endif                                   
                                        </div>

                                        <div class="form-group row">
                                                {!! Form::label('contact_number', 'Contact Number', ['class' => 'col-md-4 label_name control-label']) !!}
                                                {!! Form::text('contact_number', old('contact_number'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control', 'placeholder' => 'Your Phone Number', 'required' => '']) !!}
                                                <p class="help-block"></p>
                                                @if($errors->has('phone_number'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('phone_number') }}
                                                    </p>
                                                @endif
                                        </div>
                                        <div class="form-group row">
                                                {!! Form::label('address', 'Address', ['class' => 'col-md-4 label_name control-label']) !!}
                                                {!! Form::text('address', old('address'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control', 'placeholder' => 'Address', 'required' => '']) !!}
                                                <p class="help-block"></p>
                                                @if($errors->has('address'))
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('address') }}
                                                    </p>
                                                @endif
                                        </div>

                                        <button type="button" id="cancelForm" class="btn btn-default" data-dismiss="modal" style="float: right; margin-left: 5px;">Cancel</button>&nbsp;
                                        {!! Form::submit('Update', ['style' => 'float: right; background-color: #026C76; border: none;', 'class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!} 
                                    </div>
                                </div>                       
                            </div>
                        </div>
                    </div>
                    <!-- end of modal -->



                    <tr>
                        <td>{{$value['firstname']}} {{$value['middlename']}} {{$value['lastname']}}</td>
                        <td>{{$value['blood_type']}}</td>
                        <td>{{$value['address']}}</td>
                        <td>{{$value['birthday']}}</td>
                        <td>{{$value['age']}}</td>
                        <td>+{{$value['contact_number']}}</td>
                        <td>{{$value['details_information']}}</td>
                        <div id="options">
                            <td><a href="{{ route('admin.patients.show',$value['id']) }}" class="btn btn-xs btn-primary opt_button" style="background-color: #026C76; border: none;">View</a>
                             @can('patient_edit')
                                    <button id="editButton" style="background-color: #4682B4; border: none;" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#editPatientModal-{{$value['id']}}"> Edit </button>

                            @endcan     
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