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

    <a href="{{ route('admin.patients.newBloodRequests', ['id'=> ($patient->id)] ) }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp; New Blood Request</a>
    <p></p>

    <div class="title">Blood Requests</div>
    <div class="patient_trans">
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                   
                    <th>Component</th> 
                    <th>Quantity</th> 
                    <th>Hospital</th> 
                    <th>Transaction Code</th>
                    <th>Status</th>
                     <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blood_requests as $br)
                <tr>
                    <td>{{$br->component}}</td>
                    <td>{{$br->quantity}}</td>
                    <td>{{$br->hospital}}</td>
                    <td>{{$br->transaction_code}}</td>
                    <td>{{$br->status}}</td>
                    @if ($br->status=="With Donor")
                        <td><a href="{{ route('admin.br.assignDonor', ['id'=> ($br->id)] ) }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Encode Donor</a></td>
                    @elseif ($br->status=="Pending")
                        <td>Waiting for Donor</td>
                    @elseif ($br->status=="Matched")
                        <td>{{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('firstname')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('middlename')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('lastname')[0]}}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table> 

    </div>
@stop
