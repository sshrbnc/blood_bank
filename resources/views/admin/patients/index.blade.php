@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Patients</h3>
    @can('profile_create')
    <p>
    <button 
        type="button" 
        class="btn btn-succes" 
        data-toggle="modal"
        data-target="#newPatientModal">
        Add New
    </button>
    </p>
    @endcan

    <!-- @can('profile_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.profiles.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.profiles.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan -->

    <div class="panel panel-default">
        <div class="panel-heading">
            Patients
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-striped display compact {{ count($patients) > 0 ? 'datatable' : '' }}" id="patients_list">
                <thead>
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Name</th>
                        <th>Blood Type</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>Contact Number</th>
                        <th>Remarks</th>

                        @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                        @else
                            <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach($patients as $value)
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                            <td>{{$value['firstname']}} {{$value['middlename']}} {{$value['lastname']}}</td>
                            <td>{{$value['blood_type']}}</td>
                            <td>{{$value['address']}}</td>
                            <td>{{$value['birthday']}}</td>
                            <td>{{$value['age']}}</td>
                            <td>{{$value['contact_number']}}</td>
                            <td>{{$value['details_information']}}</td>
                            <td><a href="{{ route('admin.patients.show',$value['id']) }}" class="btn btn-xs btn-primary">View</a>
                            @can('profile_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.patients.destroy', $value['id']])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                            </td>
                    </tr>    
                    @endforeach
                </tbody>      
            </table>
        </div>
    </div>





<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ modal for create -->
<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="favoritesModalLabel"> Add new patient</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['action' => 'Admin\PatientsController@store', 'method' => 'POST']) !!}
                <div class="form-group row">
                    {{form::label('firstname', 'First Name:', ['class' => 'col-md-4 label_name'])}}
                    {{form::text('firstname', '', ['class' => 'col-md-10 input_field', 'placeholder' => ''])}}

                    @if($errors->has('firstname'))
                        <p class="help-block">
                            {{ $errors->first('firstname') }}
                        </p>
                    @endif
                </div>

                 <div class="form-group row">
                    {{form::label('middlename', 'Middle Name:', ['class' => 'col-md-4 label_name'])}}
                    {{form::text('middlename', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

                    @if($errors->has('middlename'))
                        <p class="help-block">
                            {{ $errors->first('middlename') }}
                        </p>
                    @endif
                </div>

                 <div class="form-group row">
                    {{form::label('lastname', 'Last Name:', ['class' => 'col-md-4 label_name'])}}
                    {{form::text('lastname', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

                    @if($errors->has('lastname'))
                        <p class="help-block">
                            {{ $errors->first('lastname') }}
                        </p>
                    @endif
                </div>

                <div class="form-group row">
                    {{form::label('blood_type', 'Blood Type:', ['class' => 'col-md-4 label_name'])}}
                    {{form::select('blood_type', array(''=>'','A+' => 'A+', 'AB+' => 'AB+','B+' => 'B+','O+' => 'O+','A-' => 'A-', 'AB-' => 'AB-','B-' => 'B-','O-' => 'O-'), '', ['class' => 'input_field'])}}

                    @if($errors->has('blood_type'))
                        <p class="help-block">
                            {{ $errors->first('blood_type') }}
                        </p>
                    @endif

                </div>


                <div class="form-group row">
                    {{form::label('address','Address:', ['class' => 'col-md-4 label_name'])}}
                    {{form::text('address', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>


                <div class="form-group row">
                    {{form::label('birthday', 'Birthday:', ['class' => 'col-md-4 label_name'])}}
                    {{form::date('birthday', '', ['class' => 'col-sm-10 input_field form-controldate', 'placeholder' => ''])}}

                    @if($errors->has('birthday'))
                        <p class="help-block">
                            {{ $errors->first('birthday') }}
                        </p>
                    @endif
                </div>

                <div class="form-group row">
                    {{form::label('contact_number', 'Contact Number:', ['class' => 'col-md-4 label_name'])}}
                    {{form::text('contact_number', '', ['class' => 'col-sm-10 input_field', 'placeholder' => ''])}}

                    @if($errors->has('contact_number'))
                        <p class="help-block">
                            {{ $errors->first('contact_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    
    </div>      

</div>

<!-- \\\\\\\\\\\\\\\\\\\end of modal\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

@stop




@section('javascript') 
    <script>
        @can('profile_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.profiles.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection