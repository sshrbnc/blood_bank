@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>
    
    {!! Form::model($donor, ['method' => 'PUT', 'route' => ['admin.donors.update', $donor->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.donor.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '']) !!}
                    <p class="help-block">ন্যূনত্বম 4 অক্ষর</p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('blood_type', trans('quickadmin.donor.fields.blood-type').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('blood_type'))
                        <p class="help-block">
                            {{ $errors->first('blood_type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'Aplus', false, ['required' => '']) !!}
                            A+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'Aminus', false, ['required' => '']) !!}
                            A-
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'Bplus', false, ['required' => '']) !!}
                            B+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'Bminus', false, ['required' => '']) !!}
                            B-
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'ABplus', false, ['required' => '']) !!}
                            AB+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'ABminus', false, ['required' => '']) !!}
                            AB-
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'Oplus', false, ['required' => '']) !!}
                            O+
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('blood_type', 'Ominus', false, ['required' => '']) !!}
                            O-
                        </label>
                    </div>
                    
                </div>
            </div>          
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('patient', trans('quickadmin.donor.fields.patient').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('patient', old('patient'), ['class' => 'form-control', 'placeholder' => 'Patient', 'required' => '']) !!}
                    <p class="help-block">ন্যূনত্বম 4 অক্ষর</p>
                    @if($errors->has('patient'))
                        <p class="help-block">
                            {{ $errors->first('patient') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('patient_id', trans('quickadmin.donor.fields.patient-id').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('patient_id', old('patient_id'), ['class' => 'form-control', 'placeholder' => 'Patient ID', 'required' => '']) !!}
                    <p class="help-block">ন্যূনত্বম 4 অক্ষর</p>
                    @if($errors->has('patient_id'))
                        <p class="help-block">
                            {{ $errors->first('patient_id') }}
                        </p>
                    @endif
                </div>
            </div>              
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone_number', trans('quickadmin.donor.fields.phone-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone_number'))
                        <p class="help-block">
                            {{ $errors->first('phone_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', trans('quickadmin.donor.fields.status').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('status', 'available', false, ['required' => '']) !!}
                            Available
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('status', 'unavailable', false, ['required' => '']) !!}
                            Unavailable
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('last_donation', trans('quickadmin.donor.fields.last-donation').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('last_donation', old('last_donation'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_donation'))
                        <p class="help-block">
                            {{ $errors->first('last_donation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location', trans('quickadmin.donor.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('location', old('location'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('location'))
                        <p class="help-block">
                            {{ $errors->first('location') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('details_information', trans('quickadmin.donor.fields.details-information').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('details_information', old('details_information'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="https://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

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