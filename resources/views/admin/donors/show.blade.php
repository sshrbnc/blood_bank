@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.donors.index') }}"><i class="fas fa-angle-left"></i> Back to list</a>
    <p>&nbsp;</p>


    <div class="donor_blood_type" style="font-weight: bold; font-size: 100px; float: right; color: #1a2226; padding-right: 10%;">{{ $donor->blood_type }}</div>
    <div class="donor_name" style="font-family: Roboto; font-weight: bold; font-size: 40px;">{{ $donor->lastname }}, {{ $donor->firstname}} {{$donor->middlename}} </div>
    <div class="donor_address" style="font-family: Roboto; font-size: 15px;">Address: {{ $donor->address }}</div>
    <div class="donor_phone_number" style="font-family: Roboto; font-size: 15px;">Phone Number: {{ $donor->phone_number }}</div>
    <div class="sex" style="font-family: Roboto; font-size: 15px;">Sex: {{ $donor->sex }}</div>
    <div class="birthday" style="font-family: Roboto; font-size: 15px;">Birthday: {{ $donor->birthday }}</div>
    <div class="age" style="font-family: Roboto; font-size: 15px;">Age: {{ Carbon\Carbon::parse($donor->birthday)->diffInYears(\Carbon\Carbon::now()) }}</div>
    <p></p>
    <form>
        <a href="{{ route('admin.donors.newDonation', [$donor->id]) }}" style="background-color: #026C76;" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; New Donation</a>
        <p></p>
    </form>
   
    <div class="donations" style="font-size: 19px;">Donations</div>

    <!-- @can('donor_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.donors.show', [$donor->id]) }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.donors.show', [$donor->id]) }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
        </ul>
    </p>
    @endcan -->


    <div class="donor_trans" style="background-color: #fff; border: 1px solid gray; border-radius: 5px; padding: 5px;">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    @can('donor_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan
                    <th>Donation Date</th> 
                    @can('donation_w_bc')
                    <th>Weight</th> 
                    <th>Blood Count</th> 
                    @endcan
                    <th>Result</th>
                    @can('can_see_flag')
                    <th>Flag</th>
                    @endcan
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>&nbsp;</th>

                   <!--  @if( request('show_deleted') == 1 )
                    <th>&nbsp;</th>
                    @else
                    <th>&nbsp;</th>
                    @endif -->
                </tr> 
            </thead>
            <tbody>
                @if (count($donation) > 0)
                    @foreach ($donation as $donations)
                        <tr data-entry-id="{{ $donor->id }}">
                            @can('donation_delete')    
                                @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                                <!-- @if ( request('show_deleted') != 1 )<td></td>@endif -->
                            @endcan
                            <td field-key='date_donated'>{{ \Carbon\Carbon::parse($donations->created_at)->format('M d, Y H:i') }}</td>
                            @can('donation_w_bc')
                            <td field-key='weight'>{{ $donations->weight }}</td>
                            <td field-key='blood_count'>{{ $donations->blood_count }}</td>
                            @endcan
                            <td field-key='result'>{{ $donations->result }}</td>
                            @can('can_see_flag')
                            <td field-key='flag'>{{ $donations->flag }}</td>
                            @endcan
                            <td field-key='status'>{{ $donations->status }}</td>
                            <td field-key='status'>{{ $donations->details_information }}</td>
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
                                @if($donations->processed == "Yes")
                                    <i id="processed"><i class="fas fa-check"></i> Processed</i>                                
                                @else
                                    @if(($donations->result == 'Passed' and $donations->flag == 'Green') and $donations->processed == "No")
                                    <button id="toProcess" style="background-color: #2E8B57; border: none;" type="button" class="btn btn-xs btn-success process" data-toggle="modal" data-target="#separate_modal">Process Blood</button>
                                    @endif
                                @endif
                                <!-- @can('donor_view')
                                <a href="{{ route('admin.donors.show', [$donor->id]) }}" class="btn btn-xs btn-primary">View</a>
                                @endcan -->
                                @if($donations->processed == "No")
                                    @can('donor_edit')
                                    <a href="{{ route('admin.donations.edit',[$donations->id]) }}" style="background-color: #4682B4; border: none;" class="btn btn-xs btn-info">Edit</a>
                                    @endcan                                  

                                    @can('donor_delete')
                                    <button type="button" style="border: none;" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteDonationModal">Delete</button>
                                    @endcan
                                @endif
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
    </div>
    @foreach ($donation as $donations)
    <div class="modal fade" id="deleteDonationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:30%;">
            <form action="{{ route('admin.donations.destroy', $donations->id) }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>                            
                </div>
            </form>
        </div>
    </div>
    <!-- Component Modal -->
    <div class="modal fade" id="separate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
            {!! Form::open(['method' => 'POST', 'route' => ['admin.bloods.store'], 'files' => true,]) !!}
            <form action="{{ route('admin.bloods.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">                                        
                    <div class="form-check">
                        <label for="" class="col-form-label">Component:</label>
                        <div class="row">                            
                            <div class="form-group col-md-6">
                                <input class="form-check-input position-static" onchange="displayExpwbc()" type="checkbox" value="Whole Blood" id="wbc" name="component[]">
                                <label class="form-check-label" for="wbc">&nbsp; Whole Blood </label>
                            </div>
                            <!-- <div class="col-xs-6 form-group"> -->
                            <div class="form-group col-md-6">
                                <label class="form-check-label" style="display: none;" id="expwbc">Expiry Date: <i>{{ Carbon\Carbon::now()->addMonths(2)->format('M d Y') }}</i></label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input class="form-check-input position-static" onchange="displayExprbc()" type="checkbox" value="Red Blood Cell" id="rbc" name="component[]">
                                <label class="form-check-label" for="rbc">&nbsp; Red Blood Cell </label>  
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-check-label" style="display: none;" id="exprbc">Expiry Date: <i>{{ Carbon\Carbon::now()->addMonths(3)->format('M d Y') }}</i></label>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="form-group col-md-6">
                                <input class="form-check-input position-static" onchange="displayExpplatelet()" type="checkbox" value="Platelet" id="platelet" name="component[]">
                                <label class="form-check-label" for="platelet">&nbsp; Platelet </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-check-label" style="display: none;" id="expplatelet">Expiry Date: <i>{{ Carbon\Carbon::now()->addMonths(4)->format('M d Y') }}</i></label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input class="form-check-input position-static" onchange="displayExpplasma()" type="checkbox" value="Plasma" id="plasma" name="component[]">
                                <label class="form-check-label" for="plasma">&nbsp; Plasma </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-check-label" style="display: none;" id="expplasma">Expiry Date: <i>{{ Carbon\Carbon::now()->addMonths(5)->format('M d Y') }}</i></label>
                                <!-- <input class="exps" type="date" disabled id="plasmaexp" name="exp_date[]">                                 -->
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input class="form-check-input position-static" onchange="displayExpcryo()" type="checkbox" value="Cryo" id="cryo" name="component[]">
                                <label class="form-check-label" for="cryo">&nbsp; Cryo </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-check-label" style="display: none;" id="expcryo"">Expiry Date: <i>{{ Carbon\Carbon::now()->addMonths(6)->format('M d Y') }}</i></label>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-check-input position-static" onchange="displayExpwcg()" type="checkbox" value="White Cells" id="wcg" name="component[]">
                                <label class="form-check-label" for="wcg">&nbsp; White Cells & Granulocytes </label>
                            </div>
                            <div class="col-xs-6">
                                <label class="form-label" style="display: none;" id="expwcg"">Expiry Date: <i>{{ Carbon\Carbon::now()->addMonths(7)->format('M d Y') }}</i></label> 
                                <!-- <input class="exps" type="date" disabled id="wcgexp" name="exp_date[]">-->
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        {{ Form::hidden('donor_id', $donor->id) }}          
                        {{ Form::hidden('date_donated', $donations->date_donated) }}   
                        {{ Form::hidden('donation_id', $donations->id) }}  
                        {{ Form::hidden('blood_type', $donor->blood_type) }}
                        {{ Form::hidden('processed', 'Yes') }}
                    </div>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>    
            </form>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
    @endforeach
@stop

@section('javascript') 
    <script>
        function displayExpwbc(){            
            var a = document.getElementById("expwbc");
            if (a.style.display === "none") {
                a.style.display = "block";
            } else {
                a.style.display = "none";
            }
        }
        function displayExprbc(){ 
            var b = document.getElementById("exprbc");
            if (b.style.display === "none") {
                b.style.display = "block";
            } else {
                b.style.display = "none";
            }
        }
        function displayExpplatelet(){ 
            var c = document.getElementById("expplatelet");
            if (c.style.display === "none") {
                c.style.display = "block";
            } else {
                c.style.display = "none";
            }
        }
        function displayExpplasma(){ 
            var d = document.getElementById("expplasma");
            if (d.style.display === "none") {
                d.style.display = "block";
            } else {
                d.style.display = "none";
            }
        }
        function displayExpcryo(){ 
            var e = document.getElementById("expcryo");
            if (e.style.display === "none") {
                e.style.display = "block";
            } else {
                e.style.display = "none";
            }
        }
        function displayExpwcg(){ 
            var f = document.getElementById("expwcg");
            if (f.style.display === "none") {
                f.style.display = "block";
            } else {
                f.style.display = "none";
            }
        }

        // function processedFunc(){
        //     document.getElementById("processed").style.display = "block";
        //     document.getElementById("toProcess").setAttribute("style", "display:none;");
        // }
        
        // document.getElementById('wcg').onchange = function() {
        //     document.getElementById('wcgexp').disabled = !this.checked;
        // };
    </script>
@endsection
