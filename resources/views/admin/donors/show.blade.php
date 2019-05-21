@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.donors.index') }}"><i class="fas fa-angle-left"></i> Back to list</a>
    <p>&nbsp;</p>


    <div class="donor_blood_type" style="font-weight: bold; font-size: 100px; float: right; color: #1a2226; padding-right: 10%;">{{ $donor->blood_type }}</div>
    <div class="donor_name" style="font-family: Roboto; font-weight: bold; font-size: 40px;">{{ $donor->lastname }}, {{ $donor->firstname}} {{$donor->middlename}} </div>
    <div class="donor_address" style="font-family: Roboto; font-size: 15px;"><b>Address:</b> {{ $donor->address }}</div>
    <div class="donor_phone_number" style="font-family: Roboto; font-size: 15px;"><b>Phone Number:</b> {{ $donor->phone_number }}</div>
    <div class="sex" style="font-family: Roboto; font-size: 15px;"><b>Sex:</b> {{ $donor->sex }}</div>
    <div class="birthday" style="font-family: Roboto; font-size: 15px;"><b>Birthday:</b> {{ \Carbon\Carbon::parse($donor->birthday)->format('M d, Y') }}</div>
    <div class="age" style="font-family: Roboto; font-size: 15px;"><b>Age:</b> {{ Carbon\Carbon::parse($donor->birthday)->diffInYears(\Carbon\Carbon::now()) }}</div>
    <p></p>

    <!-- New Donation -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" id="newDonation" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:40%;">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.donations.store'], 'files' => true,]) !!}
           
            <form action="{{ route('admin.donations.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        {{ csrf_field() }}          
                        {{ Form::hidden('donor_id', $donor->id) }} 
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                {!! Form::label('date_donated', 'Date', ['class' => 'control-label']) !!}
                                {!! Form::text('date_donated', Carbon\Carbon::today()->format('d-m-Y'), ['style' => 'border-radius: 8px;', 'class' => 'form-control date-picker', 'placeholder' => '', 'required' => ''])  !!}
                                <!-- <span id="date_donatedValid" name="date_donatedValid">.</span>                                   -->
                            </div>                               
                            <div class="col-md-4 mb-3">
                                <label for="weight" class="control-label">Weight (kg)</label>
                                <input id="weight" type="text" class="form-control" name="weight" style="border-radius: 8px;">
                                <span id="weightValid" name="weightValid"></span>                                  
                            </div>
                            <div class="col-md-4 mb-3">
                                <!-- {!! Form::label('blood_count', 'Blood Count', ['class' => 'control-label']) !!} -->
                                <label for="blood_count" class="control-label">Blood Count</label>
                                <input disabled id="blood_count" type="text" class="form-control" name="blood_count" value="" style="border-radius: 8px;">
                                <span id="blood_countValid" name="blood_countValid"></span>                                  
                                
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="flag" class="control-label">Flag</label>
                                <!-- <input id="flag" type="input" class="form-control" name="flag" style="border-radius: 8px;"> -->
                                <select id="flag" class="form-control" name="flag" style="border-radius: 8px;">
                                    <option selected>--</option>
                                    <option>Green</option>
                                    <option>Red</option>
                                    <option>Yellow</option>
                                    <option>Blue</option>
                                </select>
                                <span id="flagValid" name="flagValid"></span>                                  
                            </div>

                             <div class="col-md-4 mb-3">
                                
                                <label for="trans_code" class="control-label">Transaction Code</label>
                                <input id="trans_code" type="text" class="form-control" name="trans_code" value="" style="border-radius: 8px;">
                                <span id="code_valid" name="blood_countValid"></span>                                  
                                
                            </div>
                        </div>      
                        <div class="form-group">
                          <label for="details_information">Remarks on donor</label>
                          <textarea class="form-control" rows="5" id="details_information" name="details_information" style="border-radius: 8px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onsubmit="return validateForm()" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="submitBtn" name="submitBtn" type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Submit</button>
                    </div>                            
                </div>
            </form>
            {!! Form::close() !!}
        </div>
    </div>

    <button 
        type="button" 
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#newDonation">
        <i class="fas fa-plus"></i> New Donation
    </button>
  
    <p></p>
   
    <div class="donations" style="font-size: 19px;">Donations</div>

    <div class="donor_trans" style="background-color: #fff; border: 1px solid gray; border-radius: 5px; padding: 5px;">
        <table id="donor_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                   <!--  @can('donor_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan -->
                    <th>Donation Date</th> 
                    <th>Blood Request</th>
                    @can('donation_w_bc')
                    <th>Weight</th> 
                    <th>Blood Count</th> 
                    @endcan
                    @can('can_see_flag')
                    <th>Flag</th>
                    @endcan
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>&nbsp;</th>
                </tr> 
            </thead>
            <tbody>
                @if (count($donation) > 0)
                    @foreach ($donation as $donations)
                        <tr data-entry-id="{{ $donor->id }}">
                            <!-- @can('donation_delete')    
                                @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                            @endcan -->
                            <td field-key='date_donated'>{{ \Carbon\Carbon::parse($donations->created_at)->format('M d, Y H:i') }}</td>
                            <td field-key='reciepient'>
                                @if ($donations->blood_req_id != 'NULL')
                                    {{App\BloodRequests::where( ['id'=>$donations->blood_req] )->pluck('transaction_code')->first()}}
                                @else
                                    Walk-in donor
                                @endif
                            </td>
                            @can('donation_w_bc')
                            <td id="weightVal" field-key='weight'>{{ $donations->weight }}</td>
                            <td field-key='blood_count'>{{ $donations->blood_count }}</td>
                            @endcan
                            @can('can_see_flag')
                            <td field-key='flag'>{{ $donations->flag }}</td>
                            @endcan
                            <td field-key='status'>{{ $donations->status }}</td>
                            <td field-key='details_information'>{{ $donations->details_information }}</td>
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
                                    @if($donations->status != "Defer")
                                        @if(($donations->status == "Passed Checking"))
                                        <button id="toProcess" style="background-color: #2E8B57; border: none;" type="button" class="btn btn-xs btn-success process" data-toggle="modal" data-target="#separate_modal">Process Blood</button>
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
                                                                <div class="form-group col-md-6">
                                                                    <label class="form-check-label" style="display: none;" id="expwbc">Expiry Date: <i>{{ Carbon\Carbon::now()->addDays(35)->format('M d Y') }}</i></label>
                                                                </div>                            
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <input class="form-check-input position-static" onchange="displayExprbc()" type="checkbox" value="Red Blood Cell" id="rbc" name="component[]">
                                                                    <label class="form-check-label" for="rbc">&nbsp; Red Blood Cell </label>  
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="form-check-label" style="display: none;" id="exprbc">Expiry Date: <i>{{ Carbon\Carbon::now()->addDays(42)->format('M d, Y') }}</i></label>
                                                                </div>
                                                            </div>
                                                            <div class="row">                            
                                                                <div class="form-group col-md-6">
                                                                    <input class="form-check-input position-static" onchange="displayExpplatelet()" type="checkbox" value="Platelet" id="platelet" name="component[]">
                                                                    <label class="form-check-label" for="platelet">&nbsp; Platelet </label>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="form-check-label" style="display: none;" id="expplatelet">Expiry Date: <i>{{ Carbon\Carbon::now()->addDays(5)->format('M d, Y') }}</i></label>
                                                                </div>                            
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <input class="form-check-input position-static" onchange="displayExpplasma()" type="checkbox" value="Plasma" id="plasma" name="component[]">
                                                                    <label class="form-check-label" for="plasma">&nbsp; Plasma </label>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="form-check-label" style="display: none;" id="expplasma">Expiry Date: <i>{{ Carbon\Carbon::now()->addYear()->format('M d, Y') }}</i></label>
                                                                    <!-- <input class="exps" type="date" disabled id="plasmaexp" name="exp_date[]">                                 -->
                                                                </div>  
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <input class="form-check-input position-static" onchange="displayExpcryo()" type="checkbox" value="Cryo" id="cryo" name="component[]">
                                                                    <label class="form-check-label" for="cryo">&nbsp; Cryo </label>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="form-check-label" style="display: none;" id="expcryo">Expiry Date: <i>{{ Carbon\Carbon::now()->addYear()->format('M d, Y') }}</i></label>
                                                                </div>  
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <input class="form-check-input position-static" onchange="displayExpwcg()" type="checkbox" value="White Cells" id="wcg" name="component[]">
                                                                    <label class="form-check-label" for="wcg">&nbsp; White Cells & Granulocytes </label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="form-label" style="display: none;" id="expwcg">Expiry Date: <i>{{ Carbon\Carbon::now()->addHours(24)->format('M d, Y') }}</i></label> 
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
                                                            {{ Form::hidden('status', 'Pending') }}
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

                                        <button id="toDiscard" style="background-color: pink; border: none;" type="button" class="btn btn-xs" data-toggle="modal" data-target="#shaira">Discard Blood</button>
                                        <!-- Discard Blood -->
                                        <div class="modal fade" id="shaira" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="width:20%;">
                                                {!! Form::model($donations, ['method' => 'PUT', 'route' => ['admin.donations.update', $donations->id], 'files' => true,]) !!}
                                                <form action="{{ route('admin.donations.update', $donations->id) }}" method="PUT">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            {{$donations->id}}
                                                            {{ Form::hidden('date_donated', $donations->date_donated) }}          
                                                            {{ Form::hidden('donor_id', $donations->donor_id) }}         
                                                            {{ Form::hidden('weight', $donations->weight) }}
                                                            {{ Form::hidden('blood_count', $donations->blood_count) }}
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="flag" class="control-label">Flag</label>
                                                                    <select id="flag" class="form-control" name="flag" style="border-radius: 8px;">
                                                                        <option selected>--</option>
                                                                        <option>Red</option>
                                                                        <option>Yellow</option>
                                                                    </select>
                                                                    <span id="flagValid" name="flagValid"></span>                        
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="details_information">Remarks on donor</label>
                                                                    <textarea class="form-control" rows="5" name="details_information" id="details_information"  style="border-radius: 8px;"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Submit</button>
                                                        </div>                            
                                                    </div>
                                                </form>
                                                {!! Form::close() !!}   
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Edit Donation -->
                                        <div class="modal fade" id="editDonationModal-{{ $donations->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="width:40%;">
                                                {!! Form::model($donations, ['method' => 'PUT', 'route' => ['admin.donations.update', $donations->id], 'files' => true,]) !!}
                                                <form action="{{ route('admin.donations.update', $donations->id) }}" method="PUT">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            {{ csrf_field() }}  
                                                            {{ $donations->id }}  
                                                            {{ Form::hidden('donor_id', $donations->donor_id) }}
                                                            {{ Form::hidden('flag', '--') }}
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    {!! Form::label('date_donated', 'Date', ['class' => 'control-label']) !!}
                                                                    {!! Form::text('date_donated', Carbon\Carbon::today()->format('d-m-Y'), ['style' => 'border-radius: 8px;', 'class' => 'form-control date-picker', 'placeholder' => '', 'required' => ''])  !!}                            
                                                                </div>                               
                                                                <div class="col-md-4 mb-3">
                                                                    {!! Form::label('weight', 'Weight (kg)', ['class' => 'control-label']) !!}
                                                                    {!! Form::text('weight', old('weight'), ['style' => 'border-radius: 8px;', 'class' => 'form-control', 'required' => '']) !!}
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <!-- {!! Form::label('blood_count', 'Blood Count', ['class' => 'control-label']) !!} -->
                                                                    <label for="blood_count" class="control-label">Blood Count</label>
                                                                    @if($donations->status != "Defer")
                                                                        <input id="editblood_count" type="text" class="form-control" name="blood_count" value="" style="border-radius: 8px;">
                                                                    @else
                                                                        <input disabled id="editblood_count" type="text" class="form-control" name="blood_count" value="" style="border-radius: 8px;">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="details_information">Remarks on donor</label>
                                                              <textarea class="form-control" rows="5" id="details_information" name="details_information" style="border-radius: 8px;"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Submit</button>
                                                        </div>                            
                                                    </div>
                                                </form>
                                                {!! Form::close() !!}          
                                            </div>                                     
                                        </div>    

                                        @can('donor_edit')
                                        <a href="#" data-toggle="modal" data-target="#editDonationModal-{{$donations->id}}" style="background-color: #4682B4;" class="btn btn-xs btn-info">Edit</a>

                                        @endcan                            
                                        @can('donor_delete')
                                        <button type="button" style="border: none;" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteDonationModal">Delete</button>
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
                                        @endcan
                                    @else

                                    @endif
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
    
    <!-- <div class="modal fade" id="restoreDonorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:30%;">
            <form action="{{ route('admin.donors.restore', [$donor->id]) }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Yes</button>
                    </div>                            
                </div>
            </form>
        </div>

    </div> -->
    <!-- New Donation -->
    <div class="modal fade" id="newDonationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:40%;">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.donations.store'], 'files' => true,]) !!}
            <!-- <form action="{{ route('admin.donors.newDonation', [$donor->id]) }}" method="POST"> -->
            <form action="{{ route('admin.donations.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        {{ csrf_field() }}          
                        {{ Form::hidden('donor_id', $donor->id) }} 
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                {!! Form::label('date_donated', 'Date', ['class' => 'control-label']) !!}
                                {!! Form::text('date_donated', Carbon\Carbon::today()->format('d-m-Y'), ['style' => 'border-radius: 8px;', 'class' => 'form-control date-picker', 'placeholder' => '', 'required' => ''])  !!}
                                <!-- <span id="date_donatedValid" name="date_donatedValid">.</span>                                   -->
                            </div>                               
                            <div class="col-md-4 mb-3">
                                <label for="weight" class="control-label">Weight (kg)</label>
                                <input id="weight" type="text" class="form-control" name="weight" style="border-radius: 8px;">
                                <span id="weightValid" name="weightValid"></span>                                  
                            </div>
                            <div class="col-md-4 mb-3">
                                <!-- {!! Form::label('blood_count', 'Blood Count', ['class' => 'control-label']) !!} -->
                                <label for="blood_count" class="control-label">Blood Count</label>
                                <input disabled id="blood_count" type="text" class="form-control" name="blood_count" value="" style="border-radius: 8px;">
                                <span id="blood_countValid" name="blood_countValid"></span>                                  
                                
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="flag" class="control-label">Flag</label>
                                <!-- <input id="flag" type="input" class="form-control" name="flag" style="border-radius: 8px;"> -->
                                <select id="flag" class="form-control" name="flag" style="border-radius: 8px;">
                                    <option selected>--</option>
                                    <option>Green</option>
                                    <option>Red</option>
                                    <option>Yellow</option>
                                    <option>Blue</option>
                                </select>
                                <span id="flagValid" name="flagValid"></span>                                  
                            </div>
                        </div>      
                        <div class="form-group">
                          <label for="details_information">Remarks on donor</label>
                          <textarea class="form-control" rows="5" id="details_information" name="details_information" style="border-radius: 8px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onsubmit="return validateForm()" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="submitBtn" name="submitBtn" type="submit" style="background-color: #026C76; border: none;" class="btn btn-primary">Submit</button>
                    </div>                            
                </div>
            </form>
            {!! Form::close() !!}
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
    </script>
    <!-- <script type="text/javascript" src="../assets/formValidation.js"></script> -->
@endsection
