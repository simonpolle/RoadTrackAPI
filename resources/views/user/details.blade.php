@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Details User</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12"></div>
                                </div>
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua-active">
                                        <h3 class="widget-user-username">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</h3>
                                        <h5 class="widget-user-desc">{{ ucfirst($user->role->name) }}</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="{{ $user->image }}" alt="User Avatar">
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ $user->company->name }}</h5>
                                                    <span class="description-text">COMPANY</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ count($routes) }}</h5>
                                                    <span class="description-text">TOTAL ROUTES</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <div class="description-block">
                                                    <h5 class="description-header">
                                                        € {{ $total_costs }} </h5>
                                                    <span class="description-text">TOTAL COSTS FOR THIS MONTH</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ $cost_type }}</h5>
                                                    <span class="description-text">COST TYPE</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Routes from this month</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                        class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: block;">
                                        <ul class="products-list product-list-in-box">
                                            @if(count($routes) == 0)
                                                There are currently no routes for this user
                                            @endif
                                            @foreach($routes as $route)
                                                <li class="item">
                                                    <div class="product-info">
                                                        <a class="product-title">{{ $route->created_at }}
                                                            <span class="label label-danger pull-right">€ {{ number_format($route->total_cost, 2) }}</span></a>
                                                        <span class="product-description">{{ $route->distance_travelled }}
                                                            km</span>
                                                    </div>
                                                </li>
                                        @endforeach
                                        <!-- /.item -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection