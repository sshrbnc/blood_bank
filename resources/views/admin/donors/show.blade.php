@extends('layouts.app')

@section('content')
    <h3 class="page-title">Donors</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td field-key='name'>{{ $donor->name }}</td>
                        </tr>
                        <tr>
                            <th>Blood Type</th>
                            <td field-key='blood_type'>{{ $donor->blood_type }}</td>
                        </tr>
                        <tr>
                            <th>Patient</th>
                            <td field-key='patient'>{{ $donor->patient }}</td>
                        </tr>
                        <tr>
                            <th>Patient ID</th>
                            <td field-key='patient_id'>{{ $donor->patient_id }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td field-key='phone_number'>{{ $donor->phone_number }}</td>
                        </tr>                        
                        <tr>
                            <th>Status</th>
                            <td field-key='status'>{{ $donor->status }}</td>
                        </tr>
                        <tr>
                            <th>Last Donation</th>
                            <td field-key='last_donation'>{{ $donor->last_donation }}</td>
                        </tr>                       
                        <tr>
                            <th>Details Information</th>
                            <td field-key='details_information'>{!! $donor->details_information !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.donors.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
