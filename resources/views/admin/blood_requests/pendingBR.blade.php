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
        @if (count($pending_br) > 0)
            @foreach($pending_br as $br)
                <tr>
                    @can('profile_delete')
                        @if ( request('show_deleted') != 1 )<td style="text-align:center;"><input type="checkbox" id="select-all" /></td>@endif
                    @endcan
                        <td>{{$br->transaction_code}}</td>
                        <td>{{App\Patient::find($br->patient_id)->firstname}} {{App\Patient::find($br->patient_id)->middlename}} {{App\Patient::find($br->patient_id)->lastname}} </td>
                        <td>{{$br->component}}</td>
                        <td>{{App\Patient::find( $br->patient_id)->blood_type }}</td>
                        <td>{{$br->quantity}}</td>
                        <td>{{$br->hospital}}</td>
                        <td>{{$br->status}}</td>

                        <td>
                        <a href="{{ route('admin.br.assignDonor',['id'=> ($br->id)]) }}" class="btn btn-xs btn-primary">Assign Donor</a>

                        @can('profile_delete')
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                    'route' => ['admin.patients.destroy', $br->id])) !!}
                                {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endcan
                        </td>
                </tr>
            @endforeach

            @else
                <tr>
                    <td colspan="15">No Pending Blood Requests</td>
                </tr>
        @endif                   
    </tbody>
</table>

            