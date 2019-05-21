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
    <div class="col-md-6 justify-content center">
        <div class="panel panel-default">
            <div class="panel-heading">
                Available Bloods
            </div>

            <div class="panel-body table-responsive">            
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>                                                
                            <th>Blood Type</th>                        
                            <th>Supply</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <tr>                              
                            <td field-key='blood_type'>A+</td>                                
                            <td field-key='stock'>{{count($apblood)}}</td>                                
                        </tr>    
                        <tr>                              
                            <td field-key='blood_type'>A-</td>                                
                            <td field-key='stock'>{{count($anblood)}}</td>                                
                        </tr>               
                        <tr>                              
                            <td field-key='blood_type'>B+</td>                                
                            <td field-key='stock'>{{count($bpblood)}}</td>                                
                        </tr> 
                        <tr>                              
                            <td field-key='blood_type'>B-</td>                                
                            <td field-key='stock'>{{count($bnblood)}}</td>                                
                        </tr>
                        <tr>                              
                            <td field-key='blood_type'>O+</td>                                
                            <td field-key='stock'>{{count($opblood)}}</td>                                
                        </tr>
                        <tr>                              
                            <td field-key='blood_type'>O-</td>                                
                            <td field-key='stock'>{{count($onblood)}}</td>                                
                        </tr>
                        <tr>                              
                            <td field-key='blood_type'>AB+</td>                                
                            <td field-key='stock'>{{count($abpblood)}}</td>                                
                        </tr>
                        <tr>                              
                            <td field-key='blood_type'>AB-</td>                                
                            <td field-key='stock'>{{count($abnblood)}}</td>                                
                        </tr>     
                    </tbody>        
                </table>
            </div>
        </div>
    </div>

@endsection
