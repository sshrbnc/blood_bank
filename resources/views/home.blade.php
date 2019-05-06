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
    <div class="col-md-6 center">
        <div class="panel panel-default">
            <div class="panel-heading">
                Available Bloods
            </div>

            <div class="panel-body table-responsive">            
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>                                                
                            <th>Blood Type</th>                        
                            <th>In Stock</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <tr>                              
                            <td field-key='blood_type'>A+</td>                                
                            <td field-key='stock'>90</td>                                
                        </tr>    
                        <tr>                              
                            <td field-key='blood_type'>A-</td>                                
                            <td field-key='stock'>67</td>                                
                        </tr>               
                        <tr>                              
                            <td field-key='blood_type'>B+</td>                                
                            <td field-key='stock'>44</td>                                
                        </tr> 
                        <tr>                              
                            <td field-key='blood_type'>B-</td>                                
                            <td field-key='stock'>10</td>                                
                        </tr> 
                    </tbody>        
                </table>
            </div>
        </div>
    </div>

<div id="search_bar">
    <form action="/search" method="get">
        <div class="input-group">
            <input type="search" name="search" class="form-control">
            <span class="input-group-prepend">
                <button type="submit" class="btn btn-primary">Search</button>
            </span>
        </div>    
    </form>
</div>

<div class="panel-body table-responsive">
<table class="table table-striped">
<thead>
    <tr>
        <td>Name</td>
        <td>Blood Type</td>
        <td>Birthday</td>
        <td>Address</td>
    </tr>
</thead>

<tbody>
@foreach ($patients as $patient)
    <tr>
        <td>{{$patient->firstname}} {{$patient->lastname}}</td>
        <td>{{$patient->blood_type}}</td>
        <td>{{$patient->birthday}}</td>
        <td>{{$patient->address}}</td>
        <td><a href="{{ route('admin.patients.show', $patient->id ) }}" class="btn btn-xs btn-primary">View</a></td>
    </tr>
@endforeach
</tbody>
</table>
</div>

@endsection
