@extends ('backend.layouts.master')

@section ('title', 'Users')

@section('page-header')
    <h1>
        Users
        <small>{{ trans('menus.active_users') }}</small>
    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{!! link_to_route('backend.users', 'Users') !!}</li>
@stop

@section('content')
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>SF Filter</th>
            <th>PR Filter</th>
            <th>SF Permission</th>
            <th>PR Permission</th>
            <th>Group</th>
            <th>Dst</th>
            <th>Active</th>
            <th>Expire</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="user_row" user_id="{!! $user->id !!}">
                <td>{!! $user->id !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->company !!}</td>
                <td>{!! $user->auto_filer !!}</td>
                <td>{!! $user->auto_search !!}</td>
                <td>{!! $user->access_5000 !!}</td>
                <td>{!! $user->access_5045 !!}</td>
                <td>{!! $user->group_names !!}</td>
                <td>{!! $user->dest_id !!}</td>
                <td>{!! $user->active !!}</td>
                <td>{!! $user->date_exp !!}</td>
                <td>{!! $user->notes !!}</td>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">User Edit</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Save</button>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <div class="pull-left">
        {!! $users->total() !!} {{ trans('crud.users.total') }}
    </div>

    <div class="pull-right">
        {!! $users->render() !!}
    </div>

    <div class="clearfix"></div>
    {!! HTML::script('js/backend/users.js') !!}
@stop