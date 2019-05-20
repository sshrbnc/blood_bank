@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">Donors</h3> -->
    <p></p>
    <a href="{{ route('admin.donors.index') }}"><i class="fas fa-angle-left"></i> Back to list</a>
    <p></p>

    {!! Form::model($donor, ['method' => 'PUT', 'route' => ['admin.donors.update', $donor->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                </div>
                <div class="col-md-4 mb-3">
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('blood_type', 'Blood Type', ['class' => 'control-label']) !!}
                    <div>
                        {!! Form::select('blood_type', array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'), old('blood_type'), array('style' => 'border-radius: 8px;', 'class' => 'form-control')) !!}  
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('blood_type'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('blood_type') }}
                        </p>
                    @endif  
                </div>               
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    {!! Form::label('firstname', 'First Name', ['class' => 'control-label']) !!}
                    {!! Form::text('firstname', old('firstname'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'First Name', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('firstname'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('firstname') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('middlename', 'Middle Name', ['class' => 'control-label']) !!}
                    {!! Form::text('middlename', old('middlename'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Middle Name', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('middlename'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('middlename') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('lastname', 'Last Name', ['class' => 'control-label']) !!}
                    {!! Form::text('lastname', old('lastname'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Last Name', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lastname'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('lastname') }}
                        </p>
                    @endif
                </div>    
            </div>         
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    {!! Form::label('birthday', 'Birthday', ['class' => 'control-label']) !!}
                    {!! Form::text('birthday', old('birthday'), ['style' => 'border-radius: 8px;', 'class' => 'form-control date', 'placeholder' => 'Birthday', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('birthday'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('birthday') }}
                        </p>
                    @endif                                   
                </div>
                <div class="form-group col-md-4 mb-3">
                    {!! Form::label('sex', 'Sex', ['class' => 'control-label']) !!}
                    <div>
                        {!! Form::select('sex', array('Male' => 'Male', 'Female' => 'Female'), old('sex'), array('style' => 'border-radius: 8px;', 'class' => 'form-control')) !!}  
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('sex'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('sex') }}
                        </p>
                    @endif                        
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number', old('phone_number'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Your Phone Number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone_number'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('phone_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'placeholder' => 'Address', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
             {!! Form::submit('Update', ['style' => 'float: right; background-color: #026C76; border: none;', 'class' => 'btn btn-danger']) !!}
            {!! Form::close() !!} 
        </div>
    </div>

   
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
    <!-- <script>
      $(document).ready(function() {
        const btOldValue = '{{ old('blood_type') }}';
        
        if(btOldValue !== '') {
          $('#blood_type').val(btOldValue);
        }
      });
    </script>    -->        
@stop