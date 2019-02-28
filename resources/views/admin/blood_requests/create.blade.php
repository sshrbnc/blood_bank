@extends('layouts.app')

@section('content')
    <h3 class="page-title">Blood Requests</h3>
    <!-- <form method="post" action="{{ route('admin.blood_requests.store') }}"> -->
 <!--    </form> -->


    {!! Form::open(['action' => 'Admin\BloodRequestsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{form::label('component', 'Component')}}
            {{form::text('component', '', ['class' => 'form-control', 'placeholder' => 'Blood Component'])}}
        </div>

        <div class="form-group">
            {{form::label('quantity', 'Quantity')}}
            {{form::text('quantity', '', ['class' => 'form-control', 'placeholder' => 'Number of bags'])}}
        </div>


        <div class="form-group">
            {{form::label('hospital', 'Hospital')}}
            {{form::text('hospital', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>


        <div class="form-group">
            {{form::label('blood_type', 'Blood Type')}}
            {{form::text('blood_type', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class="form-group">
            {{form::label('status', 'Status')}}
            {{form::text('status', '', ['class' => 'form-control', 'placeholder' => ''])}}
        </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}



@stop

