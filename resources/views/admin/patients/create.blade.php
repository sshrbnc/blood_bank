@extends('layouts.app')

@section('content')
    <p class="page-title">Add Patient</p>

    {!! Form::open(['action' => 'Admin\PatientsController@store', 'method' => 'POST']) !!}
        <div class="form-group row">
            {{form::label('name', 'Name:', ['class' => 'col-sm-2 label_name'])}}
            {{form::text('name', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>

        <div class="form-group row">
            {{form::label('blood_type', 'Blood Type:', ['class' => 'col-sm-2 label_name'])}}
            {{form::select('blood_type', array(''=>'','A+' => 'A+', 'AB+' => 'AB+','B+' => 'B+','O+' => 'O+','A-' => 'A-', 'AB-' => 'AB-','B-' => 'B-','O-' => 'O-'), '', ['class' => 'input_field'])}}

            @if($errors->has('blood_type'))
                <p class="help-block">
                    {{ $errors->first('blood_type') }}
                </p>
            @endif

        </div>


        <div class="form-group row">
            {{form::label('address','Address:', ['class' => 'col-sm-2 label_name'])}}
            {{form::text('address', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

            @if($errors->has('address'))
                <p class="help-block">
                    {{ $errors->first('address') }}
                </p>
            @endif
        </div>


        <div class="form-group row">
            {{form::label('birthday', 'Birthday:', ['class' => 'col-sm-2 label_name'])}}
            {{form::date('birthday', '', ['class' => 'col-sm-10 input_field form-controldate', 'placeholder' => ''])}}

            @if($errors->has('birthday'))
                <p class="help-block">
                    {{ $errors->first('birthday') }}
                </p>
            @endif
        </div>

        <div class="form-group row">
            {{form::label('contact_number', 'Contact Number:', ['class' => 'col-sm-2 label_name'])}}
            {{form::text('contact_number', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

            @if($errors->has('contact_number'))
                <p class="help-block">
                    {{ $errors->first('contact_number') }}
                </p>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('details_information', 'Details Information:', ['class' => 'control-label']) !!}
            {!! Form::textarea('details_information', old('details_information'), ['class' => 'form-control editor input_field', 'placeholder' => 'Remarks']) !!}
                    
            @if($errors->has('details_information'))
                <p class="help-block">
                    {{ $errors->first('details_information') }}
                </p>
            @endif
                    
        </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    <a href="{{ route('admin.patients.index') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}



@stop

