@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>

    @can('donor_create')
    <p>
        <button style="background-color: #026C76; border: none;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addNewDonorModal"><i class="fas fa-plus"></i>&nbsp; Add New </button>
    </p>
    @endcan
    
    @can('donor_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.donors.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.donors.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
        </ul>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            Donors
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-hover {{ count($donors) > 0 ? 'datatable' : '' }} @can('donor_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('donor_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        @can('donor_id_access')<th>Donor ID</th>@endcan                        
                        @can('donor_name_access')
                            <th>Name</th>
                        @endcan
                        <th>Blood Type</th>
                        <!-- <th>Last Donation</th> -->
                        <th>Phone Number</th>
                        <th>Address</th>
                        @can('see_employee_name')
                        <th>Edited by:</th>
                        @endcan

                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($donors) > 0)
                        @foreach ($donors as $donor)
                            <tr data-entry-id="{{ $donor->id }}">
                                @can('donor_delete')    
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                @can('donor_id_access')<td field-key='id'>{{ $donor->id }}</td>@endcan  
                                @can('donor_name_access')
                                    <td field-key='firstname'>{{ $donor->firstname }} {{ $donor->middlename }} {{ $donor->lastname }}</td>
                                @endcan 
                                <td field-key='blood_type'>{{ $donor->blood_type }}</td> 
                                <!-- <td field-key='last_donation'>{{ $donor->created_at }}</td>      -->
                                <td field-key='phone_number'>+{{ $donor->phone_number }}</td>
                                <td field-key='address'>{{ $donor->address }}</td>
                                @can('see_employee_name')
                                <td field-key='employee_id'>{{ App\User::find($donor->employee_id)->name }}</td>
                                @endcan
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('donor_delete')
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#restoreDonorModal">Restore</button>                             
                                    @endcan
                                    
                                    @can('donor_delete')
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#permaDelDonorModal">Delete Permanently</button>                                    
                                    @endcan
                                </td>
                                @else
                                <td>
                                    @can('donor_view')
                                    <a href="{{ route('admin.donors.show',[$donor->id]) }}" style="background-color: #026C76; border: none;" class="btn btn-xs btn-primary">View</a>
                                    @endcan
                                    @can('donor_edit')
                                    <button id="editButton" style="background-color: #4682B4; border: none;" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#editDonorModal"> Edit </button>

                                    <!-- <a href="{{ route('admin.donors.edit',[$donor->id]) }}" style="background-color: #4682B4; border: none;" class="btn btn-xs btn-info">Edit</a> -->
                                    @endcan                                  

                                    @can('donor_delete')
                                    <div class="modal fade" id="deleteDonorModal-{{$donor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="width:30%;">
                                            <form action="{{ route('admin.donors.destroy', $donor->id) }}" method="POST">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        Are you sure?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                                                    </div>                            
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteDonorModal-{{$donor->id}}">Delete</button>
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="15">No Entries in Table</td>
                        </tr>
                    @endif
                </tbody>        
            </table>
            @foreach ($donors as $donor)

            <div class="modal fade" id="restoreDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.donors.restore', $donor->id) }}" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="permaDelDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.donors.perma_del', $donor->id) }}" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            <!-- Add New Donor Modal -->
            <div class="modal fade" id="addNewDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!-- <form action="{{ route('admin.donors.store') }}" method="POST"> -->
                    <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="favoritesModalLabel">Add New Donor</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'id' => 'addNewDonor', 'route' => ['admin.donors.store'], 'files' => true,]) !!}
                            <div class="panel-body">
                                <div class="form-group row">
                                    
                                        {!! Form::label('blood_type', 'Blood Type', ['class' => 'col-md-4 label_name control-label']) !!} 
                                         <div>
                                            {!! Form::select('blood_type', array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'), old('blood_type'), array('style' => 'border-radius: 8px;', 'id' => 'btype', 'class' => 'col-md-5 input_field form-control', 'placeholder' => '')) !!}  
                                        </div>
                                        <span class="col-md-3" id="btypeErrorMsg"></span>   
                                </div> 
                                <div class="form-group row">
                                    
                                        {!! Form::label('firstname', 'First Name', ['class' => 'col-md-4 label_name control-label']) !!}
                                        {!! Form::text('firstname', old('firstname'), ['style' => 'border-radius: 8px;', 'id' => 'fname', 'class' => 'col-md-5 input_field form-control',  'required' => '']) !!}
                                        <span class="col-md-3" id="fnameErrorMsg"></span>
                                    </div>
                                <div class="form-group row">
                                        {!! Form::label('middlename', 'Middle Name', ['class' => 'col-md-4 label_name control-label']) !!}
                                        {!! Form::text('middlename', old('middlename'), ['style' => 'border-radius: 8px;', 'id' => 'mname', 'class' => 'col-md-5 input_field form-control',  'required' => '']) !!}
                                        <span class="col-md-3" id="mnameErrorMsg"></span>
                                </div>
                                <div class="form-group row">
                                        {!! Form::label('lastname', 'Last Name', ['class' => 'col-md-4 label_name control-label']) !!}
                                        {!! Form::text('lastname', old('lastname'), ['style' => 'border-radius: 8px;', 'id' => 'lname', 'class' => 'col-md-5 input_field form-control',  'required' => '']) !!}
                                        <span class="col-md-3" id="lnameErrorMsg"></span>
                                    </div>       
                                <div class="form-group row">
                                    
                                       {!! Form::label('birthday', 'Birthday', ['class' => 'col-md-4 label_name control-label']) !!}
                                        {!! Form::text('birthday', '', ['id' => 'dob', 'style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control date', 'required' => '']) !!}
                                        <span class="col-md-3" id="dobErrorMsg"></span>        
                                    </div>
                                <div class="form-group row">
                                        {!! Form::label('sex', 'Sex', ['class' => 'col-md-4 label_name control-label']) !!}
                                        <div>
                                            {!! Form::select('sex', array('Male' => 'Male', 'Female' => 'Female'), old('sex'), array('style' => 'border-radius: 8px;', 'id' => 'sex', 'class' => 'col-md-5 input_field form-control', 'placeholder' => '')) !!}  
                                        </div>
                                        <span class="col-md-3" id="sexErrorMsg"></span>
                                </div>
                                <div class="form-group row">
                                        {!! Form::label('phone_number', 'Phone Number (+639)', ['class' => 'col-md-4 label_name control-label']) !!}
                                        {!! Form::text('phone_number', old('phone_number'), ['style' => 'border-radius: 8px;', 'id' => 'phoneNum', 'class' => 'col-md-5 input_field form-control', 'required' => '']) !!}
                                        <span class="col-md-3" id="phoneNumErrorMsg"></span>
                                    </div>
                                <div class="form-group row">                                    
                                        {!! Form::label('address', 'Address', ['class' => 'col-md-4 label_name control-label']) !!}
                                        <!-- {!! Form::text('address', old('address'), ['style' => 'border-radius: 8px;', 'id' => 'search_term', 'class' => 'form-control', 'placeholder' => 'Address', 'required' => '']) !!} -->
                                        <input id="address" class="col-md-5 input_field form-control" type="text" name="address" style="border-radius: 8px;">
                                        <span class="col-md-3" id="addressErrorMsg"></span>
                                </div>
                                <div id="location">
                                    
                                </div>
                                <button type="button" id="cancelForm" class="btn btn-default" data-dismiss="modal" style="float: right; margin-left: 5px;">Cancel</button>&nbsp;
                                {!! Form::submit('Submit', ['style' => 'float: right; background-color: #026C76; border: none;', 'class' => 'btn btn-danger']) !!}

                                {!! Form::close() !!}
                            </div>
                        </div>                                                     
                    </div>                    
                    <!-- </form> -->
                </div>
            </div>
            <!-- Edit Donor Modal -->
            @foreach ($donors as $donor)
            <div class="modal fade" id="editDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="width: 40%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="favoritesModalLabel">Edit Donor Info</h4>
                        </div>
                        <div class="modal-body" style="padding-top: 0px;">
                        {!! Form::model($donor, ['method' => 'PUT', 'route' => ['admin.donors.update', $donor->id], 'files' => true,]) !!}
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
                                        {!! Form::label('sex', 'Sex', ['class' => 'col-md-4 label_name control-label']) !!}
                                        <div>
                                            {!! Form::select('sex', array('Male' => 'Male', 'Female' => 'Female'), old('sex'), array('style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control')) !!}  
                                        </div>
                                        <p class="help-block"></p>
                                        @if($errors->has('sex'))
                                            <p class="help-block" style="color: red;">
                                                {{ $errors->first('sex') }}
                                            </p>
                                        @endif                        
                                </div>
                                <div class="form-group row">
                                        {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-md-4 label_name control-label']) !!}
                                        {!! Form::text('phone_number', old('phone_number'), ['style' => 'border-radius: 8px;', 'class' => 'col-md-5 input_field form-control', 'placeholder' => 'Your Phone Number', 'required' => '']) !!}
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
            @endforeach
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('donor_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.donors.mass_destroy') }}'; @endif
        @endcan

    </script>
    <script>
        function activatePlacesSearch(){
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
        }
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDI_MqOFHockMXhlg2e4SKdfYn3cVakv4g&libraries=places&callback=activatePlacesSearch"></script>
    <script>
        $(function() {
          $("#dob").datepicker(
            {
              minDate: new Date(1900,1-1,1), maxDate: '-16Y',
              dateFormat: 'yy-mm-dd',
              defaultDate: new Date(2003,5-1,21),
              changeMonth: true,
              changeYear: true,
              yearRange: '-110:-16'
            }
          );                    
        });
        // https://www.flipflops.org/2009/01/28/minimum-age-with-the-jquery-ui-datepicker/

        // $(function () {
        //     $("#editButton").click(function () {
        //         var donor_id = $(this).data('id');
        //         $(".modal-body #hiddenValue").val(donor_id);
        //     })
        // });
    </script>
    <script>
        $().ready(function(){
            $("#addNewDonor").submit(function(event){
                checkBtype();
                checkFname();
                checkMname();
                checkLname();
                checkBdate();
                checkSex();
                checkAddress();
                checkEmptyContact();

                if($("span").hasClass("invalid")){
                    event.preventDefault();
                }
            });

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

            function checkFname(){
                if ($("#fname").val() ===""){
                    $("#fnameErrorMsg").text("Required field");
                    $("#fnameErrorMsg").removeClass("valid").addClass("invalid");
                    console.log("la firstname");
                }
                else if ($("#fname").val() !=""){
                    $("#fnameErrorMsg").text("");
                    $("#fnameErrorMsg").removeClass("invalid").addClass("valid");
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

            function checkLname(){
                if($("#lname").val()===""){
                    $("#lnameErrorMsg").text("Required field");
                    $("#lnameErrorMsg").removeClass("valid").addClass("invalid");

                }
                else if ($("#lname").val() !=""){
                    $("#lnameErrorMsg").text("");
                    $("#lnameErrorMsg").removeClass("invalid").addClass("valid");
                }   
            }

            function checkBdate(){
                if ($("#dob").datepicker("getDate")=== null) {
                    console.log('no bday');
                    $("#dobErrorMsg").text("Required field");
                    $("#dobErrorMsg").removeClass("valid").addClass("invalid");
                }
                else{
                    $("#dobErrorMsg").text("");
                    $("#dobErrorMsg").removeClass("invalid").addClass("valid");
                }
            }

            function checkSex(){
                if($("#sex").val()===""){
                    $("#sexErrorMsg").text("Required field");
                    $("#mnameErrorMsg").removeClass("valid").addClass("invalid");

                }
                else if ($("#mname").val() !=""){
                    $("#sexErrorMsg").text("");
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

            $('#btype').on('change', checkBtype);
            $("#fname").on('input', checkFname);
            $("#mname").on('input', checkMname);
            $("#lname").on('input', checkLname);
            $("#dob").on('input', checkBdate);
            $("#sex").on('input', checkSex);
            $("#address").on('input', checkAddress);

            $('#phoneNum').on('input', function(){
                var inputNum = $(this);
                var numPat = new RegExp("^[0-9]{9}$");
                var validNum = numPat.test(inputNum.val());

                if(validNum){
                    $("#phoneNumErrorMsg").text("Number is valid");
                    $("#phoneNumErrorMsg").removeClass("invalid").addClass("valid");
                }
                else{
                    $("#phoneNumErrorMsg").text("Number is invalid");
                    $("#phoneNumErrorMsg").removeClass("valid").addClass("invalid");
                } 
            });

            function checkEmptyContact(){
                if($("#phoneNum").val()===""){
                    $("#phoneNumErrorMsg").text("Required field");
                    $("#phoneNumErrorMsg").removeClass("valid").addClass("invalid");

               }
            }
        });  
    </script>      
@endsection