@extends('layouts.app')

@section('content')
    <div class="row">
    <a href="{{ route('admin.patients.index') }}" ><span>&nbsp; &nbsp;</span>
    <i class="fas fa-angle-left back_arrow"></i>
        &nbsp;<span class="back_to">Back to List</span> 
    </a>

    </div>
    <div class="patient_blood_type">
        {{$patient->blood_type}}
    </div>

    <div class ="patient_name">
        {{$patient->firstname}} {{$patient->middlename}} {{$patient->lastname}}
    </div>

    <div class="patient_det">
        <b>Address:</b> {{$patient->address}}
    </div>

    <div class="patient_det">
        <b>Birthday:</b> {{$patient->birthday}}
    </div>

    <div class="patient_det">
        <b>Age:</b> {{ Carbon\Carbon::parse($patient->birthday)->diffInYears(\Carbon\Carbon::now()) }}
    </div>

    <div class="patient_det">
        <b>Contact Number:</b> {{$patient->contact_number}}
    </div>
    <p></p>

    <a href="{{ route('admin.patients.newBloodRequests', ['id'=> ($patient->id)] ) }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp; New Blood Request</a>
    <p></p>

    <div class="title">Blood Requests</div>
    <div class="patient_trans">
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                   
                    <th>Component</th> 
                    <th>Quantity</th> 
                    <th>Hospital</th> 
                    <th>Transaction Code</th>
                    <th>Status</th>
                     <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blood_requests as $br)
                <tr>
                    <td>{{$br->component}}</td>
                    <td>{{$br->quantity}}</td>
                    <td>{{$br->hospital}}</td>
                    <td>{{$br->transaction_code}}</td>
                    <td>{{$br->status}}</td>
                    @if ($br->status=="With Donor")

        <!-- Add New Donor Modal -->
    <div class="modal fade" id="addNewDonorModal-{{$br->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 40%;">
            <!-- <form action="{{ route('admin.donors.store') }}" method="POST"> -->
            <div class="modal-content">
                <div class="modal-body">
                    {!! Form::open(['method' => 'POST', 'route' => ['admin.donors.storeFromBr', 'br_id'=>$br->id], 'files' => true,]) !!}
                    <div class="panel-body">
                        <div class="row">
                            
                                {!! Form::label('blood_type', 'Blood Type', ['class' => 'control-label']) !!}
                                <div>
                                    {!! Form::select('blood_type', array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'), old('blood_type'), array('style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Select Blood Type')) !!}  
                                </div> 
                                <p class="help-block"></p>
                                @if($errors->has('blood_type'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('blood_type') }}
                                    </p>
                                @endif  
                                         
                        </div> 
                        <div class="row">
                            
                                {!! Form::label('firstname', 'First Name', ['class' => 'control-label']) !!}
                                {!! Form::text('firstname', old('firstname'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'First Name', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('firstname'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('firstname') }}
                                    </p>
                                @endif
                            </div>
                        <div class="row">
                                {!! Form::label('middlename', 'Middle Name', ['class' => 'control-label']) !!}
                                {!! Form::text('middlename', old('middlename'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Middle Name', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('middlename'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('middlename') }}
                                    </p>
                                @endif
                        </div>
                        <div class="row">
                                {!! Form::label('lastname', 'Last Name', ['class' => 'control-label']) !!}
                                {!! Form::text('lastname', old('lastname'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Last Name', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('lastname'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('lastname') }}
                                    </p>
                                @endif
                            </div>       
                        <div class="row">
                            
                               {!! Form::label('birthday', 'Birthday', ['class' => 'control-label']) !!}
                                {!! Form::text('birthday', old('birthday'), ['id' => 'dob', 'style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Birthday', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('birthday'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('birthday') }}
                                    </p>
                                @endif             
                            </div>
                        <div class="row">
                                {!! Form::label('sex', 'Sex', ['class' => 'control-label']) !!}
                                <div>
                                    {!! Form::select('sex', array('Male' => 'Male', 'Female' => 'Female'), old('sex'), array('style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Select Sex')) !!}  
                                </div>
                                <p class="help-block"></p>
                                @if($errors->has('sex'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('sex') }}
                                    </p>
                                @endif
                        </div>
                        <div class="row">
                                {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
                                {!! Form::text('phone_number', old('phone_number'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Your Phone Number', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('phone_number'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('phone_number') }}
                                    </p>
                                @endif
                            </div>
                        <div class="row">                                    
                                {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('address', old('address'), ['style' => 'border-radius: 8px;', 'id' => 'search_term', 'class' => 'form-control', 'placeholder' => 'Address', 'required' => '']) !!} -->
                                <input id="search_term" class="form-control" type="text" name="address" style="border-radius: 8px;">
                                <p class="help-block"></p>
                                @if($errors->has('address'))
                                    <p class="help-block" style="color: red;">
                                        {{ $errors->first('address') }}
                                    </p>
                                @endif
                        </div>
                        <div id="location">
                            
                        </div>
                        {!! Form::submit('Submit', ['style' => 'float: right; background-color: #026C76; border: none;', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>                                                     
            </div>                    
            <!-- </form> -->
        </div>
    </div>


                        <td>
                            <button style="background-color: #026C76; border: none;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addNewDonorModal-{{$br->id}}"><i class="fas fa-plus"></i>&nbsp; Encode Donor </button>
                        </td>
                    @elseif ($br->status=="Pending")
                        <td>Waiting for Donor</td>
                    @elseif ($br->status=="Matched")
                        <td>{{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('firstname')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('middlename')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('lastname')[0]}}</td>
                    @endif
                </tr>

                @endforeach
            </tbody>
        </table> 
    </div>

@stop
