@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Blood Requests</h3>
    <!-- @can('profile_create')
    <p>
        <a href="{{ route('admin.blood_requests.create') }}" class="btn btn-success">Add New</a>
        
    </p>
    @endcan -->

    <!-- @can('profile_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.profiles.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.profiles.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan -->


    <div class="panel panel-default">

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                        <th>Patient</th>
                        <th>Blood Component</th>
                        <th>Blood Type</th>
                        <th>Quantity</th>
                        <th>Hospital</th>
                        <th>Status</th>
                        @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                        @else
                            <th>&nbsp;</th>
                        @endif
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($blood_requests as $value)
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<td style="text-align:center;"><input type="checkbox" id="select-all" /></td>@endif
                        @endcan
                            <td>{{App\Patient::find( $value['patient_id'])->name }}</td>
                            <td>{{$value['component']}}</td>
                            <td>{{App\Patient::find( $value['patient_id'])->blood_type }}</td>
                            <td>{{$value['quantity']}}</td>
                            <td>{{$value['hospital']}}</td>
                            <td>{{$value['status']}}</td>
                        @endforeach
                    </tr>
                    </tbody>
                    
                
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