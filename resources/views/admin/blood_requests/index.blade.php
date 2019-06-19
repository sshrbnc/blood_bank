@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Blood Requests</h3>
    <button id="all_br" class="btn btn-xs btn-primary">All</button>
    <button id="pending_br" class="btn btn-xs btn-primary">Pending</button>
    <button id="wd_br" class="btn btn-xs btn-primary">With Donor</button>
    <button id="matched_br" class="btn btn-xs btn-primary">Matched</button>
    <button id="released_br" class="btn btn-xs btn-primary">Released</button>

    <p></p>


     <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-striped" id="datatable_table">
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
                    <th>Donor</th>
                   <!--  @if( request('show_deleted') == 1 ) -->
                    <th>&nbsp;</th>
                    <!-- @else -->
                    <th>&nbsp;</th>
                    <!-- @endif -->
                </tr>
            </thead>
            <tbody id="table_body">
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#pending_br").click(function(){
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '{{url('/admin/categorize')}}',
                    data: 'stat=Pending',
                    success: function(response){
                        $("#table_body").html(response);
                    }
                });

            });

            $("#wd_br").click(function(){
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '{{url('/admin/categorize')}}',
                    data: 'stat=With Donor',
                    success: function(response){
                        $("#table_body").html(response);
                    }
                });
            });
            $("#matched_br").click(function(){
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '{{url('/admin/categorize')}}',
                    data: 'stat=Matched',
                    success: function(response){
                        $("#table_body").html(response);
                    }
                });
            });
            $("#released_br").click(function(){
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '{{url('/admin/categorize')}}',
                    data: 'stat=Released',
                    success: function(response){
                        $("#table_body").html(response);
                    }
                });
            });
            $("#all_br").click(function(){
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '{{url('/admin/categorize')}}',
                    data: 'stat=all',
                    success: function(response){
                        $("#table_body").html(response);
                    }
                });
            });

            $("#datatable_table").DataTable();
        });

    </script>
@endsection