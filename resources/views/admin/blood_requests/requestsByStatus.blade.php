
                @if (count($data) > 0)
                    @foreach($data as $br)
                        <tr>
                            @can('profile_delete')
                                @if ( request('show_deleted') != 1 )<td style="text-align:center;"><input type="checkbox" id="select-all" /></td>@endif
                            @endcan
                                <td>{{$br->transaction_code}}</td>
                                <td>{{App\Patient::find($br->patient_id)->firstname}} {{App\Patient::find($br->patient_id)->middlename}} {{App\Patient::find($br->patient_id)->lastname}} </td>
                                <td>{{$br->component}}</td>
                                <td>{{App\Patient::find( $br->patient_id)->blood_type}}</td>
                                <td>{{$br->quantity}}</td>
                                <td>{{$br->hospital}}</td>
                                <td>{{$br->status}}</td>

                    
                                @if ( $br->status=='Pending')
                                    <td>pending</td>
                                @elseif($br->status =='Urgent')
                                    @if($br->blood_id == null)
                                        <td>Waiting for available blood</td>
                                    @else{
                                        <td>{{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('firstname')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('middlename')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('lastname')[0]}}</td>
                                    }
                                    @endif
                                @else
                                    <td>{{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('firstname')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('middlename')[0]}} {{App\Donor::where( ['id'=>App\Blood::find($br->blood_id)->donor_id] )->pluck('lastname')[0]}}</td>
                                
                                    
                                @endif
                                

                                <td>
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
                            <td colspan="15">No Listed Blood Requests</td>
                        </tr>
                @endif