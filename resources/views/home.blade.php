@extends('layouts.app')

@section('content')
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>
                <div class="panel-body">
                    @lang('quickadmin.qa_dashboard_text')
                    <p>
                        You are logged in as <strong> {{ Auth::user()->email }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div> -->

    

    
    <div class="row">

        <div class="col-md-6 justify-content center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b style="font-size: 16px;">Blood type: O </b>
                </div>

                <div class="panel-body table-responsive">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Component</th>                        
                                <th>Number of bags</th>
                            </tr>
                            <tr>                                                
                                <th></th>                        
                                <th>Rh: POSITIVE (+)</th>
                                <th>Rh: NEGATIVE (-)</th>
                            </tr>
                        </thead>
                        <tbody>       
                            <tr>                              
                                <td field-key='blood_type'>Red Blood Cell</td>                                
                                <td field-key='stock'>{{count($opblood->where('component', 'Red Blood Cell'))}}</td>
                                <td field-key='stock'>{{count($onblood->where('component', 'Red Blood Cell'))}}</td>
                            </tr>               
                            <tr>                              
                                <td field-key='blood_type'>Whole Blood</td>                                
                                <td field-key='stock'>{{count($opblood->where('component', 'Whole Blood'))}}</td>
                                <td field-key='stock'>{{count($onblood->where('component', 'Whole Blood'))}}</td> 
                            </tr> 
                            <tr>                              
                                <td field-key='blood_type'>Platelet</td>                                
                                <td field-key='stock'>{{count($opblood->where('component', 'Platelet'))}}</td>
                                <td field-key='stock'>{{count($onblood->where('component', 'Platelet'))}}</td>
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Plasma</td>                                
                                <td field-key='stock'>{{count($opblood->where('component', 'Plasma'))}}</td>
                                <td field-key='stock'>{{count($onblood->where('component', 'Plasma'))}}</td>        
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Cryo</td>                                
                                <td field-key='stock'>{{count($opblood->where('component', 'Cryo'))}}</td>
                                 <td field-key='stock'>{{count($onblood->where('component', 'Cryo'))}}</td>       
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>White Cells</td>                                
                                <td field-key='stock'>{{count($opblood->where('component', 'Cryo'))}}</td>
                                <td field-key='stock'>{{count($onblood->where('component', 'Cryo'))}}</td>
                            </tr>
                        </tbody>        
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 justify-content center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b style="font-size: 16px;">Blood type: A </b>
                </div>

                <div class="panel-body table-responsive">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Component</th>                        
                                <th>Number of bags</th>
                            </tr>
                            <tr>                                                
                                <th></th>                        
                                <th>Rh: POSITIVE (+)</th>
                                <th>Rh: NEGATIVE (-)</th>
                            </tr>
                        </thead>
                        <tbody>       
                            <tr>                              
                                <td field-key='blood_type'>Red Blood Cell</td>                                
                                <td field-key='stock'>{{count($apblood->where('component', 'Red Blood Cell'))}}</td>
                                <td field-key='stock'>{{count($anblood->where('component', 'Red Blood Cell'))}}</td>
                            </tr>               
                            <tr>                              
                                <td field-key='blood_type'>Whole Blood</td>                                
                                <td field-key='stock'>{{count($apblood->where('component', 'Whole Blood'))}}</td>
                                <td field-key='stock'>{{count($anblood->where('component', 'Whole Blood'))}}</td> 
                            </tr> 
                            <tr>                              
                                <td field-key='blood_type'>Platelet</td>                                
                                <td field-key='stock'>{{count($apblood->where('component', 'Platelet'))}}</td>
                                <td field-key='stock'>{{count($anblood->where('component', 'Platelet'))}}</td>
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Plasma</td>                                
                                <td field-key='stock'>{{count($apblood->where('component', 'Plasma'))}}</td>
                                <td field-key='stock'>{{count($anblood->where('component', 'Plasma'))}}</td>        
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Cryo</td>                                
                                <td field-key='stock'>{{count($apblood->where('component', 'Cryo'))}}</td>
                                 <td field-key='stock'>{{count($anblood->where('component', 'Cryo'))}}</td>       
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>White Cells</td>                                
                                <td field-key='stock'>{{count($apblood->where('component', 'Cryo'))}}</td>
                                <td field-key='stock'>{{count($anblood->where('component', 'Cryo'))}}</td>
                            </tr>
                        </tbody>        
                    </table>
                </div>
            </div>   
        </div>

    </div>

    <div class="row">

        <div class="col-md-6 justify-content center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b style="font-size: 16px;">Blood type: B </b>
                </div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Component</th>                        
                                <th>Number of bags</th>
                            </tr>
                            <tr>                                                
                                <th></th>                        
                                <th>Rh: POSITIVE (+)</th>
                                <th>Rh: NEGATIVE (-)</th>
                            </tr>
                        </thead>
                        <tbody>       
                            <tr>                              
                                <td field-key='blood_type'>Red Blood Cell</td>                                
                                <td field-key='stock'>{{count($bpblood->where('component', 'Red Blood Cell'))}}</td>
                                <td field-key='stock'>{{count($bnblood->where('component', 'Red Blood Cell'))}}</td>
                            </tr>               
                            <tr>                              
                                <td field-key='blood_type'>Whole Blood</td>                                
                                <td field-key='stock'>{{count($bpblood->where('component', 'Whole Blood'))}}</td>
                                <td field-key='stock'>{{count($bnblood->where('component', 'Whole Blood'))}}</td> 
                            </tr> 
                            <tr>                              
                                <td field-key='blood_type'>Platelet</td>                                
                                <td field-key='stock'>{{count($bpblood->where('component', 'Platelet'))}}</td>
                                <td field-key='stock'>{{count($bnblood->where('component', 'Platelet'))}}</td>
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Plasma</td>                                
                                <td field-key='stock'>{{count($bpblood->where('component', 'Plasma'))}}</td>
                                <td field-key='stock'>{{count($bnblood->where('component', 'Plasma'))}}</td>        
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Cryo</td>                                
                                <td field-key='stock'>{{count($bpblood->where('component', 'Cryo'))}}</td>
                                 <td field-key='stock'>{{count($bnblood->where('component', 'Cryo'))}}</td>       
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>White Cells</td>                                
                                <td field-key='stock'>{{count($bpblood->where('component', 'Cryo'))}}</td>
                                <td field-key='stock'>{{count($bnblood->where('component', 'Cryo'))}}</td>
                            </tr>
                        </tbody>        
                    </table>
                </div> 
            </div>
        </div>

        <div class="col-md-6 justify-content center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b style="font-size: 16px;">Blood type: AB </b>
                </div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Component</th>                        
                                <th>Number of bags</th>
                            </tr>
                            <tr>                                                
                                <th></th>                        
                                <th>Rh: POSITIVE (+)</th>
                                <th>Rh: NEGATIVE (-)</th>
                            </tr>
                        </thead>
                        <tbody>       
                            <tr>                              
                                <td field-key='blood_type'>Red Blood Cell</td>                                
                                <td field-key='stock'>{{count($abpblood->where('component', 'Red Blood Cell'))}}</td>
                                <td field-key='stock'>{{count($abnblood->where('component', 'Red Blood Cell'))}}</td>
                            </tr>               
                            <tr>                              
                                <td field-key='blood_type'>Whole Blood</td>                                
                                <td field-key='stock'>{{count($abpblood->where('component', 'Whole Blood'))}}</td>
                                <td field-key='stock'>{{count($abnblood->where('component', 'Whole Blood'))}}</td> 
                            </tr> 
                            <tr>                              
                                <td field-key='blood_type'>Platelet</td>                                
                                <td field-key='stock'>{{count($abpblood->where('component', 'Platelet'))}}</td>
                                <td field-key='stock'>{{count($abnblood->where('component', 'Platelet'))}}</td>
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Plasma</td>                                
                                <td field-key='stock'>{{count($abpblood->where('component', 'Plasma'))}}</td>
                                <td field-key='stock'>{{count($abnblood->where('component', 'Plasma'))}}</td>        
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>Cryo</td>                                
                                <td field-key='stock'>{{count($abpblood->where('component', 'Cryo'))}}</td>
                                 <td field-key='stock'>{{count($abnblood->where('component', 'Cryo'))}}</td>       
                            </tr>
                            <tr>                              
                                <td field-key='blood_type'>White Cells</td>                                
                                <td field-key='stock'>{{count($abpblood->where('component', 'Cryo'))}}</td>
                                <td field-key='stock'>{{count($abnblood->where('component', 'Cryo'))}}</td>
                            </tr>
                        </tbody>        
                    </table>
                </div> 
            </div>
        </div>

    </div>
        



@endsection
