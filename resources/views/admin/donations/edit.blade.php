@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>
        
    <a href="{{ route('admin.donors.index') }}" class="btn btn-success"><i class="fas fa-angle-left"></i> Back to list</a>
    <p></p>

    {!! Form::model($donation, ['method' => 'PUT', 'route' => ['admin.donations.update', $donation->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit
        </div>

        <div class="panel-body">
            {{ Form::hidden('donor_id', $donation->donor_id) }} 
            <div class="row">
                <div class="col-md-4 mb-3">
                    {!! Form::label('date_donated', 'Date', ['class' => 'control-label']) !!}
                    {!! Form::text('date_donated', $donation->date_donated, ['class' => 'form-control date-picker', 'placeholder' => '', 'required' => ''])  !!}
                    <p class="help-block"></p>
                    @if($errors->has('date_donated'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('date_donated') }}
                        </p>
                    @endif
                </div>                                
                <div class="col-md-4 mb-3">
                    {!! Form::label('weight', 'Weight (kg)', ['class' => 'control-label']) !!}
                    {!! Form::text('weight', old('weight'), ['class' => 'form-control', 'placeholder' => 'Weight', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('weight'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('weight') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('blood_count', 'Blood Count', ['class' => 'control-label']) !!}
                    {!! Form::text('blood_count', old('blood_count'), ['class' => 'form-control', 'placeholder' => 'Blood Count', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('blood_count'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('blood_count') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    {!! Form::label('result', 'Result', ['class' => 'control-label result']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('result'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('result') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('result', 'Passed', false, ['required' => '']) !!}
                            Passed
                        </label>
                        <label>
                            {!! Form::radio('result', 'Not Passed', false, ['required' => '']) !!}
                            Not Passed
                        </label>
                    </div>                    
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('status', 'Pending', false, ['required' => '']) !!}
                            Pending
                        </label>
                        <label>
                            {!! Form::radio('status', 'Matched', false, ['required' => '']) !!}
                            Matched
                        </label>
                        <label>
                            {!! Form::radio('status', 'Discard', false, ['required' => '']) !!}
                            Discard
                        </label>
                    </div>  
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('flag', 'Flag', ['class' => 'control-label']) !!}
                    {!! Form::text('flag', old('flag'), ['class' => 'form-control', 'placeholder' => 'Flag', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('flag'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('flag') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('details_information', 'Remarks on donor', ['class' => 'control-label']) !!}
                    {!! Form::textarea('details_information', old('details_information'), ['class' => 'form-control details_info', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('details_information'))
                        <p class="help-block" style="color: red;">
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