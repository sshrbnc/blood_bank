@extends('layouts.app')

@section('content')
    <h3 class="page-title">Employees</h3>

    <a href="{{ url()->previous() }}"><i class="fas fa-angle-left"></i>&nbsp; Back </a>
    <p></p>

    <div class="panel panel-default" style="width: 50%;">
        <div class="panel-heading">
            <b style="font-size: 16px;">Profile</b>
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
