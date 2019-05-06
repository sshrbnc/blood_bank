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
            <table class="table table-striped  {{ count($blood_requests) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                        <th>Transaction ID</th>
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
                            <td>{{$value['transaction_code']}}</td>
                            <td>{{App\Patient::find($value['patient_id'])->firstname}} {{App\Patient::find($value['patient_id'])->middlename}} {{App\Patient::find($value['patient_id'])->lastname}} </td>
                            <td>{{$value['component']}}</td>
                            <td>{{App\Patient::find( $value['patient_id'])->blood_type }}</td>
                            <td>{{$value['quantity']}}</td>
                            <td>{{$value['hospital']}}</td>
                            <td>{{$value['status']}}</td>

                            <td>
                            <a href="{{ route('admin.br.assignDonor',['id'=> ($value['id'])]) }}" class="btn btn-xs btn-primary">Assign Donor</a>

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