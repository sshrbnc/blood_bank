@extends('layouts.app')

@section('content')
    <h3 class="page-title">Patients</h3>
    <!-- <form method="post" action="{{ route('admin.blood_requests.store') }}"> -->
    <!--   </form> -->

    {!! Form::open(['action' => 'Admin\PatientsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{form::label('name', 'Name')}}
            {{form::text('name', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class="form-group">
            {{form::label('blood_type', 'Blood Type')}}
            {{form::text('blood_type', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>


        <div class="form-group">
            {{form::label('address', 'Address')}}
            {{form::text('address', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>


        <div class="form-group">
            {{form::label('birthday', 'Birthday')}}
            {{form::date('birthday', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class="form-group">
            {{form::label('age', 'Age')}}
            {{form::text('age', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class="form-group">
            {{form::label('contact_number', 'Contact Number')}}
            {{form::text('contact_number', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class="form-group">
                    {!! Form::label('details_information', trans('quickadmin.profile.fields.details-information').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('details_information', old('details_information'), ['class' => 'form-control editor', 'placeholder' => 'About Yourself']) !!}
                    <p class="help-block"></p>
                    
        </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}



@stop

