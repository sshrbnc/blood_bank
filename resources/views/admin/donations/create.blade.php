@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.donors.show', [$donor[0]->id]) }}"><i class="fas fa-angle-left"></i> Back </a>
    <p></p>
    
    {!! Form::open(['method' => 'POST', 'route' => ['admin.donations.store'], 'files' => true,]) !!}

    <form action="{{ route('admin.donations.store') }}" method="POST">
        {{ csrf_field() }} 
        <div class="panel panel-default">
            <div class="panel-heading">
                New Donation
            </div>        
            <div class="panel-body">
                {{ Form::hidden('donor_id', $donor[0]->id) }}   
                <div class="row">
                    <div class="col-md-4 mb-3">
                        {!! Form::label('date_donated', 'Date', ['class' => 'control-label']) !!}
                        {!! Form::text('date_donated', Carbon\Carbon::today()->format('d-m-Y'), ['style' => 'border-radius: 8px;', 'class' => 'form-control date-picker', 'placeholder' => '', 'required' => ''])  !!}
                        <p class="help-block"></p>
                        @if($errors->has('date_donated'))
                            <p class="help-block" style="color: red;">
                                {{ $errors->first('date_donated') }}
                            </p>
                        @endif
                    </div>                               
                    <div class="col-md-4 mb-3">
                        <!-- {!! Form::label('weight', 'Weight (kg)', ['class' => 'control-label']) !!} -->
                        <label for="weight" class="control-label">Weight (kg)</label>
                        <input id="weight" type="text" class="form-control" name="weight" style="border-radius: 8px;"><i class="fas fa-check"></i>
                        <p class="help-block"></p>
                        @if($errors->has('weight'))
                            <p class="help-block" style="color: red;">
                                {{ $errors->first('weight') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <!-- {!! Form::label('blood_count', 'Blood Count', ['class' => 'control-label']) !!} -->
                        <label for="blood_count" class="control-label">Blood Count</label>
                        <input id="blood_count" type="text" class="form-control" name="blood_count" value="" style="border-radius: 8px;">
                        <p class="help-block"></p>
                        @if($errors->has('blood_count'))
                            <p class="help-block" style="color: red;">
                                {{ $errors->first('blood_count') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        <!-- {!! Form::label('result', 'Result', ['class' => 'control-label']) !!}   -->
                        <label for="result" class="control-label">Result</label>
                        <!-- <div>
                            <p class="result1" style="visibility: hidden;">Passed</p>
                            <p class="result2" style="visibility: hidden;">Did not pass</p>
                        </div> -->
                        <!-- <label id="msg"></label> -->
                        <select id="result" class="form-control form-control-sm" name="result" style="border-radius: 8px;">
                            <option value="">--</option>
                            <option value="Passed">Passed</option>
                            <option value="Did not Pass">Did not Pass</option>
                        </select>  
                        <p class="help-block"></p>
                        @if($errors->has('result'))
                            <p class="help-block" style="color: red;">
                                {{ $errors->first('result') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <!-- {!! Form::label('status', 'Status', ['id' => 'statuses', 'class' => 'control-label']) !!} -->
                        <label for="status" class="control-label">Status</label>
                        <select id="status" class="form-control form-control-sm" name="status" style="border-radius: 8px;">
                            <option>Pending</option>
                            <option>Matched</option>
                        </select>
                        <p class="help-block"></p>
                        @if($errors->has('status'))
                            <p class="help-block" style="color: red;">
                                {{ $errors->first('status') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <!-- {!! Form::label('flag', 'Flag', ['class' => 'control-label']) !!}  -->
                        <label for="flag" class="control-label">Flag</label>
                        <select id="flag" class="form-control form-control-sm" name="flag" style="border-radius: 8px;">
                            <option>Green</option>
                            <option>Red</option>
                            <option>Yellow</option>
                        </select> 
                        <p class="help-block"></p>
                        @if($errors->has('flag'))
                            <p class="help-block" style="color: red;">
                                {{ $errors->first('flag') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                  <label for="details_information">Remarks on donor</label>
                  <textarea class="form-control" rows="5" id="details_information" style="border-radius: 8px;"></textarea>
                </div>
            </div>  
            <button type="submit" class="btn btn-danger" style="float: right; background-color: #026C76; border: none;">Submit</button>

        </div>
    </form>
    {!! Form::close() !!}

    <!-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} -->
    
@stop

@section('javascript')
    @parent
    <script src="https://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
    <script>       
        // $(document).ready(function(){
        //     var weightVal = $('#weight').val();
        //     $("#weight").change(function(){
        //         console.log(weightVal);
        //     });
        // });
        // var dest = document.getElementById("destinationTextField");
        // var $displayWeight = $("#msg");
        // var $weightInput = $("#weight");
        // var $weightValue = $weightInput.val();
        // $displayWeight.text(titleValue);              
    </script>        
@stop