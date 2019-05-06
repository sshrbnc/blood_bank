@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.roles.title')</h3>
    <a href="{{ route('admin.roles.index') }}"><i class="fas fa-angle-left"></i>&nbsp; Back to list</a>
    <p></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ $role->title }}/s</b>
        </div>

        <div class="panel-body table-responsive">
            <!-- <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Title</th>
                            <td field-key='title'>{{ $role->title }}</td>
                        </tr>
                    </table>
                </div>
            </div> -->
            <!-- Nav tabs -->
            <!-- <ul class="nav nav-tabs" role="tablist">
                
            <li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
            </ul> -->

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="users">
                    <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td field-key='name'>{{ $user->name }}</td>
                                        <td field-key='email'>{{ $user->email }}</td>
                                        <td field-key='role'>{{ $user->role->title or '' }}</td>
                                        <td>
                                            @can('view')
                                            <a href="{{ route('users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                            @endcan
                                            @can('edit')
                                            <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                            @endcan
                                            @can('delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                'route' => ['users.destroy', $user->id])) !!}
                                            {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">No entries in table.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
