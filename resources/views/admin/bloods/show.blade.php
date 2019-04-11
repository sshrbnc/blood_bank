@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bloods</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            View
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                        <th>Donor ID</th> 
                            <td field-key='donor_id'>{{ $blood->donor_id }}</td>
                        </tr>
                        <th>Blood Type</th> 
                            <td field-key='blood_type'>{{ $blood->blood_type }}</td>
                        </tr>
                        <tr>
                            <th>Blood Component</th>
                            <td field-key='component'>{{ $blood->component }}</td>
                        </tr>                   
                        <tr>
                            <th>Date Doanted</th>
                            <td field-key='date_donated'>{{ $blood->date_donated }}</td>
                        </tr> 
                        <tr>
                            <th>Expiry Date</th>
                            <td field-key='exp_date'>{{ $blood->exp_date }}</td>
                        </tr> 
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.bloods.index') }}" class="btn btn-success">Back to list</a>
        </div>
    </div>
@stop
