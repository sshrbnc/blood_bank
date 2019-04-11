@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bloods</h3>
    
    {!! Form::model($blood, ['method' => 'PUT', 'route' => ['admin.bloods.update', $blood->id], 'files' => true,]) !!}
    
    <a href="{{ route('admin.bloods.index') }}" class="btn btn-success"><i class="fas fa-angle-left"></i>&nbsp; Back to list</a>
    <p></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    {!! Form::label('donor_id', 'Donor ID', ['class' => 'control-label']) !!}
                    {!! Form::text('donor_id', $donor_id, old('donor_id'), ['class' => 'form-control', 'placeholder' => 'Donor ID', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('donor_id'))
                        <p class="help-block">
                            {{ $errors->first('donor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
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
                <div class="col-md-4 mb-3">
                    {!! Form::label('component', 'Component'.'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('component'))
                        <p class="help-block">
                            {{ $errors->first('component') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('component', 'PRC', false, ['required' => '']) !!}
                            PRC
                        </label>
                        <label>
                            {!! Form::radio('component', 'FFT', false, ['required' => '']) !!}
                            FFT
                        </label>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('date_donated', 'Date Donated'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date_donated', old('date_donated'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date_donated'))
                        <p class="help-block">
                            {{ $errors->first('date_donated') }}
                        </p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('exp_date', 'Expiry Date'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('exp_date', old('exp_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('exp_date'))
                        <p class="help-block">
                            {{ $errors->first('exp_date') }}
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