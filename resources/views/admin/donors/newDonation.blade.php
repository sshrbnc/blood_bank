@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>
        
    <a href="{{ route('admin.donors.index') }}" class="btn btn-success"><i class="fas fa-angle-left"></i> Back to list</a>
    <p></p>

    {!! Form::model($donor, ['method' => 'POST', 'route' => ['admin.donors.store', $donor->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            New Donation
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '']) !!}
                    <p class="help-block">Min 4 chars</p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>            
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('blood_type', 'Blood Type'.'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('blood_type'))
                        <p class="help-block">
                            {{ $errors->first('blood_type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'A+', false, ['required' => '']) !!}
                            A+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'A-', false, ['required' => '']) !!}
                            A-
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'B+', false, ['required' => '']) !!}
                            B+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'B-', false, ['required' => '']) !!}
                            B-
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'AB+', false, ['required' => '']) !!}
                            AB+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'AB-', false, ['required' => '']) !!}
                            AB-
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'O+', false, ['required' => '']) !!}
                            O+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'O-', false, ['required' => '']) !!}
                            O-
                        </label>
                    </div>                    
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('sex', 'Sex'.'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sex'))
                        <p class="help-block">
                            {{ $errors->first('sex') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('sex', 'M', false, ['required' => '']) !!}
                            M
                        </label>
                        <label>
                            {!! Form::radio('sex', 'F', false, ['required' => '']) !!}
                            F
                        </label>
                    </div>     
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('birthday', 'Birthday'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('birthday', old('birthday'), ['class' => 'form-control date', 'placeholder' => 'Birthday', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('birthday'))
                        <p class="help-block">
                            {{ $errors->first('birthday') }}
                        </p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('age', 'Age'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('age', old('age'), ['class' => 'form-control', 'placeholder' => 'Age', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('age'))
                        <p class="help-block">
                            {{ $errors->first('age') }}
                        </p>
                    @endif
                </div>
            </div>   
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('address', 'Address'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Address', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    {!! Form::label('phone_number', 'Phone Number'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'placeholder' => 'Your Phone Number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone_number'))
                        <p class="help-block">
                            {{ $errors->first('phone_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('weight', 'Weight'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('weight', old('weight'), ['class' => 'form-control', 'placeholder' => 'Weight', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('weight'))
                        <p class="help-block">
                            {{ $errors->first('weight') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('blood_count', 'Blood Count'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('blood_count', old('blood_count'), ['class' => 'form-control', 'placeholder' => 'Blood Count', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('blood_count'))
                        <p class="help-block">
                            {{ $errors->first('blood_count') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('status', 'Status'.'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('status', 'Passed', false, ['required' => '']) !!}
                            Passed
                        </label>
                        <label>
                            {!! Form::radio('status', 'Not Passed', false, ['required' => '']) !!}
                            Not Passed
                        </label>
                    </div>                    
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('date_donated', 'Date'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date_donated', old('date_donated'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date_donated'))
                        <p class="help-block">
                            {{ $errors->first('date_donated') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('details_information', 'Details Information'.'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('details_information', old('details_information'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('details_information'))
                        <p class="help-block">
                            {{ $errors->first('details_information') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit('Update', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="https://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop