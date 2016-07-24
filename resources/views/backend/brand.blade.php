@extends ('backend.layouts.master')

@section ('title', 'Users')

@section('page-header')
    <h1>
        Brand
    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{!! link_to_route('backend.brands', 'Brand') !!}</li>
@stop

@section('content')

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="widget-box transparent">
                            <h4 class="lighter">
                                <i class="icon-address"></i>
                                Brand Details
                            </h4>
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                   {!! Session::get('success') !!}
                                </div>
                            @endif

                            <table class="table table-bordered table-striped">

                                <tbody>

                                <tr>
                                    <td>Brand Image</td>

                                    <td>
                                        @if ($brand &&  !empty($brand->path))
                                            <img src="/{!! $brand->path !!}" height="100"/>
                                        @else
                                            <b class="green">
                                                Image not upload yet
                                            </b>
                                        @endif

                                        @if ($brand)
                                                <span class="pull-right"><a href="/admin/brand-delete/{!! $user_id !!}/{!! $brand->id !!}">Remove</a></span>
                                            @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Hash Tag</td>

                                    <td>
                                        @if ($brand)
                                            {!! $brand->hashtag !!}
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div><!-- /widget-box -->
                    </div>
                    <div class="col-sm-6">
                        <div class="widget-box transparent">
                            <h4 class="lighter">
                                <i class="icon-address"></i>
                                Add/Update Brand Information
                            </h4>
                            <p class="errors">{!!$errors->first('brand_image')!!}</p>
                            @if(Session::has('error'))
                                <p class="errors">{!! Session::get('error') !!}</p>
                            @endif
                            <form method="post" action="/admin/brands" enctype="multipart/form-data" name="brand">
                                <table class="table table-bordered table-striped">

                                    <tbody>
                                    <tr>
                                        <td>
                                            Brand Image
                                        </td>

                                        <td>
																	<span class="btn btn-default btn-file">
																	    Browse <input name="brand_image" type="file">
																	</span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>HashTag</td>

                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">#</span>
                                                <input type="text" class="form-control" name="hashtag" placeholder="hashtag" aria-describedby="basic-addon1">
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>


                                        <td colspan="2" style="text-align: center;">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="icon-file icon-white"></i> Save
                                            </button>
                                            <input type="hidden" name="user_id" value="{!! $user_id !!}">
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                {{ csrf_field() }}

                            </form>
                        </div><!-- /widget-box -->
                    </div>

                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        <meta name="_token" content="{!! csrf_token() !!}" />
@stop