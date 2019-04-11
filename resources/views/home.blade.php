@extends('layouts.app')

@section('content')
    <div class="row">
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

        <form action="/search" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- <form action="/transaction" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search available blood"> 
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>
    <h3 class="page-title center">Available Bloods</h3>
    <div class="panel-body table-responsive">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped table-dark">
                    <thead class="thead-light">
                        <th>Blood Type</th>
                        <th>Quantity</th>
                    </thead>    
                </table>
            </div>
        </div>
    </div> -->
@endsection
