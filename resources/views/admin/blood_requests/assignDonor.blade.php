@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="">
    <div class="patient_name">
        {{$patient->firstname}} {{$patient->middlename}} {{$patient->lastname}} <i class="fas fa-wheelchair"></i>
    </div>

    <div class="patient_blood_type">
        {{$patient->blood_type}}
    </div>

    <div class="patient_det" id="br_transcode">
        <b>Transaction ID: </b>{{$br->transaction_code}}
    </div>

    <div class="patient_det" id="br_component">
        <b>Blood Component: </b>{{$br->component}}
    </div>

    <div class="patient_det" id="br_hosp">
        <b>Hospital: </b>{{$br->hospital}}
    </div>

    <a href="{{ route('admin.patients.show',$br->id) }}" class="btn btn-xs btn-primary">Add unexisting donor</a>

</div>

<div class="panel panel-default">
        <div class="panel-heading">
            Donor List
        </div>

        <div class="panel-body table-responsive list_panel">
            <table style="" class="table table-bordered table-striped {{ count($donors) > 0 ? 'datatable' : '' }} @can('donor_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
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
                        <th></th>
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
                                @can('donor_name_access')<td field-key='name'>{{ $donor->firstname }}</td>@endcan                        
                                <td field-key='blood_type'>{{ $donor->blood_type }}</td>   
                                <td field-key='last_donation'>Jan 22 17</td>
                                <td field-key='phone_number'>{{ $donor->phone_number }}</td>
                                <td field-key='address'>{{ $donor->address }}</td>
                                
                                <td><a href="{{ route('admin.br.donor_receipient',['did' => $donor->id, 'bcode' => $br->transaction_code, 'bid' => $br->id]) }}" class="btn btn-xs btn-primary">Assign</a></td>
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
    <script type="text/javascript">

       
    </script>
@endsection
