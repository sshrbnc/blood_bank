@extends('layouts.app')

@section('content')
   
    <p class="page-title">New Blood Request</p>

    <div class ="row given_det">
        <b class="label_name col-sm-2">Patient Name:</b>
         <span class="patient_det col-sm-10">{{$patient[0]->name}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Blood Type:</b>
        <span class="patient_det col-sm-10">{{$patient[0]->blood_type}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Address:</b> 
        <span class="patient_det col-sm-10">{{$patient[0]->address}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Birthday:</b> 
        <span class="patient_det col-sm-10">{{$patient[0]->birthday}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Age:</b> 
        <span class="patient_det col-sm-10">{{ Carbon\Carbon::parse($patient[0]->birthday)->diffInYears(\Carbon\Carbon::now()) }}</span>
    </div>

    <div class="row">
        <b class="label_name col-sm-2">Contact Number:</b> 
        <span class="patient_det col-sm-10">{{$patient[0]->contact_number}}</span>
    </div>

    <p></p>


    {!! Form::open(array('route' => array('admin.blood_requests.store', 'method' => 'POST'))) !!}

        <div class="form-group">
        {{form::hidden('patient_id', $patient[0]->id )}}
        </div>

        <div class="form-group row">
            {{form::label('component', 'Component:',['class' => 'col-sm-2 label_name'])}}

            {{form::select('component', array(''=>'','PRBC' => 'PRBC', 'WBC' => 'WBC','Whole blood' => 'Whole Blood','Platelets' => 'Platelets','Frozen Plasma' => 'Frozen Plasma', 'Cryoprecipitate ' => 'Cryoprecipitate ','Cryosupernate' => 'Cryosupernate'), null,  array('class'=>'input_field col-sm-10'))}}
        </div>

        <div class="form-group row">
            {{form::label('quantity', 'Quantity:',['class' => 'col-sm-2 label_name'])}}
            {{form::text('quantity', '', ['placeholder' => 'Number of bags','class'=>'input_field col-sm-10'])}}
        </div>


        <div class="form-group row">
            {{form::label('hospital', 'Hospital:', ['class' => 'col-sm-2 label_name'])}}
            {{form::text('hospital', '', [ 'placeholder' => '','class'=>'input_field col-sm-10'])}}
        </div>


        <div class="form-group row">
            {{form::label('status', 'Status:',['class' => 'col-sm-2 label_name'])}}
            {{form::select('status', array('P'=>'Pending', 'R' => 'Released', 'D' => 'With Donor'), '', ['class'=>'input_field col-sm-10'])}}
        </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    <a href="{{ route('admin.patients.index') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}



@stop

