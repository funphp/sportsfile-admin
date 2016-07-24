<script type="text/javascript">
    $(function () {
        $('#expire').datetimepicker({
            keepOpen:false,
            format : 'MM/DD/YYYY'
        });
    });
</script>
<style>
    ul
    {
        list-style-type: none;
    }
</style>
<form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

    <div class="form-group error">
        <label for="inputTask" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="{{$user->name}}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="{{$user->password}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Organization</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="org" name="org" placeholder="Organization" value="{{$user->company}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">SF Filter</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="auto_filer" name="auto_filer" placeholder="SF Filter" value="{{$user->auto_filer}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">PR Filter</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="auto_search" name="auto_search" placeholder="PR Filter" value="{{$user->auto_search}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Download Notes</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="notes" name="notes" placeholder="Download Notes" value="{{$user->notes}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3">Active</label>
        <div class="col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" {{ ($user->active == 1) ? "checked" : '' }} id="active" name="active" value="1">
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Expire</label>
        <div class="col-sm-9">
            <div class='input-group date' id='expire'>
                <input type='text' class="form-control" name="date_exp" value="{{$user->date_exp}}"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
    </div>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <h4 class="panel-title">
                        SF Permissions
                    </h4>
                    </a>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul>
                            @foreach ($sfPermission as $sf)
                                <li><input type="checkbox" name="access_5000[]"  {{ ($sf['selected'] == true) ? "checked" : '' }} value="{{$sf['value']}}"> {{$sf['name']}} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    <h4 class="panel-title">
                        PR Permissions
                    </h4>
                    </a>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($prPermission as $pr)
                                <li><input type="checkbox" name="access_5045[]"  {{ ($pr['selected'] == true) ? "checked" : '' }} value="{{$pr['value']}}"> {{$pr['name']}} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    <h4 class="panel-title">
                        Groups
                    </h4>
                    </a>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($group as $g)
                                <li><input type="checkbox" name="group_names[]"  {{ ($g->selected == true) ? "checked" : '' }} value="{{$g->group_id}}"> {{$g->name}} </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                    <h4 class="panel-title">
                        Destinations
                    </h4>
                    </a>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($destination as $d)
                                <li><input type="checkbox" name="dest_id[]"  {{ ($d->selected == true) ? "checked" : '' }} value="{{$d->id}}"> {{$d->name}} </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <input type="hidden" id="id" name="id" value="{{$user->id}}">
</form>