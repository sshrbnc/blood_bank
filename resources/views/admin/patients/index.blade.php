@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Patients</h3>
    @can('profile_create')
    <p>
        <a href="{{ route('admin.patients.create') }}" class="btn btn-success">Add New</a>
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
            <table class="table table-bordered table-striped ">
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
                        <th>Details Information</th>
                        @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                        @else
                            <th>&nbsp;</th>
                        @endif
                    </tr>


                    @foreach($patients as $value)
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                      
                            <th>{{$value['name']}}</th>
                            <th>{{$value['blood_type']}}</th>
                            <th>{{$value['address']}}</th>
                            <th>{{$value['birthday']}}</th>
                             <th>{{$value['age']}}</th>
                            <th>{{$value['contact_number']}}</th>
                            <th>{{$value['details_information']}}</th>
                        @endforeach
                    </tr>
                    
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('profile_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.profiles.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection