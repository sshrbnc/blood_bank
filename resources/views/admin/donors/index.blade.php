@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>

    @can('donor_create')
    <p>
        <a href="{{ route('admin.donors.create') }}" class="btn btn-success" style="background-color: #026C76;"><i class="fas fa-plus"></i>&nbsp; Add New </a>
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
            <table class="table table-bordered table-hover {{ count($donors) > 0 ? 'datatable' : '' }} @can('donor_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('donor_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        @can('donor_id_access')<th>Donor ID</th>@endcan                        
                        @can('donor_name_access')
                            <th>Name</th>
                        @endcan
                        <th>Blood Type</th>
                        <th>Last Donation</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        @can('see_employee_name')
                        <th>Edited by:</th>
                        @endcan

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
                                @can('donor_name_access')
                                    <td field-key='firstname'>{{ $donor->firstname }} {{ $donor->middlename }} {{ $donor->lastname }}</td>
                                @endcan 
                                <td field-key='blood_type'>{{ $donor->blood_type }}</td> 
                                <td field-key='last_donation'>{{ $donor->created_at }}</td>     
                                <td field-key='phone_number'>{{ $donor->phone_number }}</td>
                                <td field-key='address'>{{ $donor->address }}</td>
                                @can('see_employee_name')
                                <td field-key='employee_id'>{{ App\User::find($donor->employee_id)->name }}</td>
                                @endcan
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('donor_delete')
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#restoreDonorModal">Restore</button>                             
                                    @endcan
                                    @can('donor_delete')
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#permaDelDonorModal">Delete Permanently</button>                                    
                                    @endcan
                                </td>
                                @else
                                <td>
                                    @can('donor_view')
                                    <a href="{{ route('admin.donors.show',[$donor->id]) }}" style="background-color: #026C76; border: none;" class="btn btn-xs btn-primary">View</a>
                                    @endcan
                                    @can('donor_edit')
                                    <a href="{{ route('admin.donors.edit',[$donor->id]) }}" style="background-color: #4682B4; border: none;" class="btn btn-xs btn-info">Edit</a>
                                    @endcan                                  

                                    @can('donor_delete')
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteDonorModal">Delete</button>
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
            @foreach ($donors as $donor)
            <div class="modal fade" id="deleteDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.donors.destroy', $donor->id) }}" method="POST">
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
            <div class="modal fade" id="restoreDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.donors.restore', $donor->id) }}" method="POST">
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
            <div class="modal fade" id="permaDelDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:30%;">
                    <form action="{{ route('admin.donors.perma_del', $donor->id) }}" method="POST">
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
        @can('donor_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.donors.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection