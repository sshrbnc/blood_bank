@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>

    @can('donor_create')
    <p>
        <a href="{{ route('admin.donors.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp; Add New </a>
    </p>
    @endcan
    
    @can('donor_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.donors.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.donors.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
        </ul>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            Donor List
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($donors) > 0 ? 'datatable' : '' }} @can('donor_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('donor_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        @can('donor_id_access')<th>Donor ID</th>@endcan                        
                        @can('donor_name_access')<th>Name</th>@endcan
                        <th>Blood Type</th>
                        <th>Last Donation</th>
                        <th>Phone Number</th>
                        <th>Address</th>

                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($donors) > 0)
                        @foreach ($donors as $donor)
                            <tr data-entry-id="{{ $donor->id }}">
                                @can('donor_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                @can('donor_id_access')<td field-key='id'>{{ $donor->id }}</td>@endcan  
                                @can('donor_name_access')<td field-key='name'>{{ $donor->name }}</td>@endcan                        
                                <td field-key='blood_type'>{{ $donor->blood_type }}</td>   
                                <td field-key='last_donation'>Jan 22 17</td>
                                <td field-key='phone_number'>{{ $donor->phone_number }}</td>
                                <td field-key='address'>{{ $donor->address }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('donor_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.donors.restore', $donor->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('donor_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.donors.perma_del', $donor->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                                @else
                                <td>
                                    @can('donor_view')
                                    <a href="{{ route('admin.donors.show',[$donor->id]) }}" class="btn btn-xs btn-primary">View</a>
                                    @endcan
                                    @can('donor_edit')
                                    <a href="{{ route('admin.donors.edit',[$donor->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    @endcan                                  

                                    @can('donor_delete')
                                        <!-- <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete_modal">Delete</button> -->
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('Sure?');",
                                            'route' => ['admin.donors.destroy', $donor->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="15">No Entries in Table</td>
                        </tr>
                    @endif
                </tbody>        
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('donor_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.donors.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection