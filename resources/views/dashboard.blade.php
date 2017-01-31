@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Main</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $cars }}</h3>
                            <p>Cars</p>
                        </div>
                        <a href="{{ URL::route('car.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $total_cost }}</h3>
                            <p>Total Cost</p>
                        </div>
                        <a href="{{ URL::route('route.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>
                            <p>Users</p>
                        </div>
                        <a href="{{ URL::route('user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $routes }}</h3>
                            <p>Routes</p>
                        </div>
                        <a href="{{ URL::route('route.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recent Routes</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <ul class="products-list product-list-in-box">
                        @foreach($recent_routes as $recent_route)
                            @foreach($users as $user)
                                <li class="item">
                                    @if($recent_route->user_id == $user->id)
                                        <div class="product-info">
                                            <a href="javascript:void(0)"
                                               class="product-title">{{ $user->first_name }} {{ $user->last_name }}
                                                <span class="label label-danger pull-right">€{{ $recent_route->total_cost }}</span></a>
                                            <span class="product-description">{{ $recent_route->distance_travelled }}km</span>
                                        </div>
                                    @endif
                                </li>


                            @endforeach
                        <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="display: block;">
                    <a href="javascript:void(0)" class="uppercase">View All Routes</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <div style="padding: 10px 0px; text-align: center;">
                <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <div class="visible-xs visible-sm"><!-- AdminLTE -->
                    <ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px"
                         data-ad-client="ca-pub-4495360934352473" data-ad-slot="5866534244"></ins>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                </div>
                <div class="hidden-xs hidden-sm"><!-- Home large leaderboard -->
                    <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px"
                         data-ad-client="ca-pub-4495360934352473" data-ad-slot="1170479443"></ins>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection