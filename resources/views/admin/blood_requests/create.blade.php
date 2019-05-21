@extends('layouts.app')

@section('content')
   
    <p class="page-title">New Blood Request</p>

    <div class ="row given_det">
        <b class="label_name col-sm-2">Patient Name:</b>
         <span class="patient_det col-sm-10">{{$patient->firstname}} {{$patient->middlename}} {{$patient->lastname}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Blood Type:</b>
        <span class="patient_det col-sm-10">{{$patient->blood_type}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Address:</b> 
        <span class="patient_det col-sm-10">{{$patient->address}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Birthday:</b> 
        <span class="patient_det col-sm-10">{{$patient->birthday}}</span>
    </div>

    <div class="row given_det">
        <b class="label_name col-sm-2">Age:</b> 
        <span class="patient_det col-sm-10">{{ Carbon\Carbon::parse($patient->birthday)->diffInYears(\Carbon\Carbon::now()) }}</span>
    </div>

    <div class="row">
        <b class="label_name col-sm-2">Contact Number:</b> 
        <span class="patient_det col-sm-10">{{$patient->contact_number}}</span>
    </div>

    <p></p>


    {!! Form::open(array('route' => array('admin.blood_requests.store', 'method' => 'POST'))) !!}

        <div class="form-group">
        {{form::hidden('patient_id', $patient->id )}}
        </div>

        <div class="form-group row">
            {{form::label('component', 'Component:',['class' => 'col-sm-2 label_name'])}}

            {{form::select('component', array(''=>'','Red Blood Cell' => 'Red Blood Cell', 'White Cells & Granulocytes' => 'White Cells & Granulocytes','Whole blood' => 'Whole Blood','Platelet' => 'Platelet','Plasma' => 'Plasma', 'Cryo ' => 'Cryo'), null,  array('class'=>'input_field form-control col-sm-10'))}}
            <span id="componentErrMsg"></span>
        </div>

        <div class="form-group row">
            {{form::label('quantity', 'Quantity:',['class' => 'col-sm-2 label_name'])}}
            {{form::text('quantity', '', ['placeholder' => 'Number of bags','class'=>'input_field form-control col-sm-10'])}}
            <span id="quantErrMsg"></span>
        </div>


        <div class="form-group row">
            {{form::label('hospital', 'Hospital:', ['class' => 'col-sm-2 label_name'])}}
            {{form::text('hospital', '', [ 'placeholder' => '','class'=>'input_field form-control col-sm-10'])}}
            <span id="hospitalErrMsg"></span>
        </div>


        <div class="form-group row">
            {{form::label('status', 'Status:',['class' => 'col-sm-2 label_name'])}}
            {{form::select('status', array('Pending'=>'Pending', 'Released' => 'Released', 'With Donor' => 'With Donor'), '', ['class'=>'input_field form-control col-sm-10'])}}
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                {{form::checkbox('urgent', '1', false, ['class'=>'', 'id'=>'markUrgent'])}}
                {{form::label('urgent', 'Mark as urgent',['class' =>  'label_name'])}}
            </div>
        </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary', 'id'=>'submit_br'])}}
    <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}

@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $("#submit_br").on('click', function(event){
            console.log("submit_form");
            checkComponent();
            checkHospital();
            checkQuant();
            if($("span").hasClass("invalid")){
                event.preventDefault();    
            }
            
        });

        $("#component").on('input', checkComponent);
        $("#hospital").on('input', checkHospital);

        function checkComponent(){
            if($("#component").val()===""){
                $("#componentErrMsg").text("Required");
                $("#componentErrMsg").removeClass("valid").addClass("invalid");
            }
            else{
                $("#componentErrMsg").text("");
                $("#componentErrMsg").removeClass("invalid").addClass("valid");
            }
        }

        function checkHospital(){
             if($("#hospital").val()===""){
                $("#hospitalErrMsg").text("Required");
                $("#hospitalErrMsg").removeClass("valid").addClass("invalid");
            }
            else{
                $("#hospitalErrMsg").text("");
                $("#hospitalErrMsg").removeClass("invalid").addClass("valid");
            }   
        }

        function checkQuant(){
             if($("#quantity").val()===""){
                $("#quantErrMsg").text("Required");
                $("#quantErrMsg").removeClass("valid").addClass("invalid");
            }
            else{
                $("#quantErrMsg").text("");
                $("#quantErrMsg").removeClass("invalid").addClass("valid");
            }   
        }

        $('#quantity').on('input', function(){
                var inputNum = $(this);
                var numPat = new RegExp("^[1-9]{1}$");
                var validNum = numPat.test(inputNum.val());

                if(validNum){
                    $("#quantErrMsg").text("Input is valid");
                    $("#quantErrMsg").removeClass("invalid").addClass("valid");
                }
                else{
                    $("#quantErrMsg").text("Input is invalid");
                    $("#quantErrMsg").removeClass("valid").addClass("invalid");
                } 
            });
    });
</script>
@endsection

