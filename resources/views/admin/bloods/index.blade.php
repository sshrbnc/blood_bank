@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bloods</h3>

    @can('blood_create')
    <p>
        <a href="{{ route('admin.bloods.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp; Add New</a>
    </p>
    @endcan
    
    @can('blood_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.bloods.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.bloods.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
        </ul>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            Blood List
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-hover {{ count($bloods) > 0 ? 'datatable' : '' }} @can('blood_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('blood_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        @can('donor_id_access')
                            <th>Donor ID</th>   
                        @endcan  
                        
                        @can('donor_name_access')
                            <th>Donor Name</th>   
                        @endcan                             
                        <th>Blood Type</th>
                        <th>Blood Component</th>
                        <th>Date Donated</th>
                        <th>Expiry Date</th>

                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($bloods) > 0)
                        @foreach ($bloods as $blood)
                            <tr data-entry-id="{{ $blood->id }}">
                                @can('blood_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                @can('donor_id_access')
                                    <td field-key='donor_id'>{{ $blood->donor_id }}</td>  
                                @endcan  
                                @can('donor_name_access')
                                    <td field-key='name'><a href="{{ route('admin.donors.show', [$blood->donor_id]) }}">{{ App\Donor::find($blood->donor_id)->firstname }} {{ App\Donor::find($blood->donor_id)->middlename }} {{ App\Donor::find($blood->donor_id)->lastname }}</a></td>   
                                @endcan
                                <td field-key='blood_type'>{{ $blood->blood_type }}</td>                                
                                <td field-key='component'>{{ $blood->component }}</td>
                                <td field-key='date_donated'>{{ \Carbon\Carbon::parse($blood->created_at)->format('M d, Y H:i') }}</td>
                                <td field-key='exp_date'>{{ $blood->exp_date }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('donor_delete')
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#restoreBloodModal">Restore</button>                             
                                    @endcan
                                    @can('donor_delete')
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#permaDelBloodModal">Delete Permanently</button>                                    
                                    @endcan
                                    <!-- @can('blood_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.bloods.restore', $blood->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('blood_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.bloods.perma_del', $blood->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan -->
                                </td>
                                @else
                                <td>
                                    @can('blood_view')
                                    <a href="{{ route('admin.bloods.show',[$blood->id]) }}" style="background-color: #026C76; border: none;" class="btn btn-xs btn-primary">View</a>
                                    @endcan
                                    @can('blood_edit')
                                    <a href="{{ route('admin.bloods.edit',[$blood->id]) }}" style="background-color: #4682B4; border: none;" class="btn btn-xs btn-info">Edit</a>
                                    @endcan
                                    @can('donor_delete')
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteBloodModal">Delete</button>
                                    @endcan
                                    <!-- @can('blood_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.bloods.destroy', $blood->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan -->
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="15">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>        
            </table>
            @foreach ($bloods as $blood)
            <div class="modal fade" id="deleteBloodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.bloods.destroy', $blood->id) }}" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="restoreBloodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.bloods.restore', $blood->id) }}" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="permaDelBloodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.bloods.perma_del', $blood->id) }}" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('blood_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.bloods.mass_destroy') }}'; @endif
        @endcan
    </script>
@endsection