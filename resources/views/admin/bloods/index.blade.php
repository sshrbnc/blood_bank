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
            <table class="table table-bordered table-striped {{ count($bloods) > 0 ? 'datatable' : '' }} @can('blood_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
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
                                    <td field-key='name'><a href="{{ route('admin.donors.show', [$blood->donor_id]) }}">{{ App\Donor::find($blood->donor_id)->name }}</a></td>   
                                @endcan
                                <td field-key='blood_type'>{{ $blood->blood_type }}</td>                                
                                <td field-key='component'>{{ $blood->component }}</td>
                                <td field-key='date_donated'>{{ $blood->date_donated }}</td>
                                <td field-key='exp_date'>{{ $blood->exp_date }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('blood_delete')
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
                                    @endcan
                                </td>
                                @else
                                <td>
                                    @can('blood_view')
                                    <a href="{{ route('admin.bloods.show',[$blood->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('blood_edit')
                                    <a href="{{ route('admin.bloods.edit',[$blood->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('blood_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.bloods.destroy', $blood->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
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