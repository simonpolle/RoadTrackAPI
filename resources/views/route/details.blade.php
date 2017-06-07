@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Routes
                <small>Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Routes</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Details Route</h3>
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
                                        <h3 class="widget-user-username">{{ ucfirst($route->user->first_name) }} {{ ucfirst($route->user->last_name) }}</h3>
                                        <h5 class="widget-user-desc">{{ ucfirst($route->user->role->name) }}</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="{{ $route->user->image }}" alt="User Avatar">
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ $route->car->licence_plate }}</h5>
                                                    <span class="description-text">LICENCE PLATE</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ $route->distance_travelled }}
                                                        km</h5>
                                                    <span class="description-text">DISTANCE TRAVELLED</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <div class="description-block">
                                                    <h5 class="description-header">
                                                        € {{ number_format($route->total_cost, 2) }}</h5>
                                                    <span class="description-text">TOTAL COST</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ $route->created_at }}</h5>
                                                    <span class="description-text">DATE</span>
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
                                        <h3 class="box-title">Route</h3>

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
                                        <div style="height: 500px; width: 100%" id="map"></div>
                                    </div>
                                    <script>
                                        function initMap() {
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 14,
                                                center: {!! json_encode($firstLocation) !!},
                                                mapTypeId: 'terrain'
                                            });

                                            var flightPlanCoordinates = {!! json_encode($coordinates) !!};

                                            var flightPath = new google.maps.Polyline({
                                                path: flightPlanCoordinates,
                                                geodesic: true,
                                                strokeColor: '#FF0000',
                                                strokeOpacity: 1.0,
                                                strokeWeight: 1
                                            });

                                            flightPath.setMap(map);
                                        }
                                    </script>
                                    <script async defer
                                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4D5-FxSBcvFmF4vq0YZ1EbDiT7WCsL7M&callback=initMap">
                                    </script>
                                    <!-- /.box-body -->
                                    <div class="box-footer text-center" style="display: block;">
                                        <a href="http://localhost:8000/route" class="uppercase">View All Routes</a>
                                    </div>
                                    <!-- /.box-footer -->
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
        </section>
        <!-- /.content -->
    </div>
@endsection