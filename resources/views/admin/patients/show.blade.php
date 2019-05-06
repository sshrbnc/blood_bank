@extends('layouts.app')

@section('content')
    <div class="row">
    <a href="{{ route('admin.patients.index') }}" ><span>&nbsp; &nbsp;</span>
    <i class="fas fa-angle-left back_arrow"></i>
        &nbsp;<span class="back_to">Back to List</span> 
    </a>

    </div>
    <div class="patient_blood_type">
        {{$patient->blood_type}}
    </div>

    <div class ="patient_name">
        {{$patient->firstname}} {{$patient->middlename}} {{$patient->lastname}}
    </div>

    <div class="patient_det">
        <b>Address:</b> {{$patient->address}}
    </div>

    <div class="patient_det">
        <b>Birthday:</b> {{$patient->birthday}}
    </div>

    <div class="patient_det">
        <b>Age:</b> {{ Carbon\Carbon::parse($patient->birthday)->diffInYears(\Carbon\Carbon::now()) }}
    </div>

    <div class="patient_det">
        <b>Contact Number:</b> {{$patient->contact_number}}
    </div>
    <p></p>

    <a href="{{ route('admin.patients.newBloodRequests', ['id'=> ($patient->id)] ) }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; New Blood Request</a>
    <p></p>

    <div class="title">Blood Requests</div>
    <div class="patient_trans">
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    @can('donor_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan
                    <th>Component</th> 
                    <th>Quantity</th> 
                    <th>Hospital</th> 
                    <!-- <th>Transaction Code</th> -->
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blood_requests as $br)
                <tr>
                    <td><a href="{{ route('admin.br.assignDonor', ['id'=> ($br->id)] ) }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Add Donor</a></td>
                    <td>{{$br->component}}</td>
                    <td>{{$br->quantity}}</td>
                    <td>{{$br->hospital}}</td>
                    <td>{{$br->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table> 

    </div>
@stop
