@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Routes
                <small>Search Routes</small>
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
                            <h3 class="box-title">Search Routes</h3>
                            <div class="input-group" style="margin-top: 0.5%">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="search form-control" placeholder="What you looking for?">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover dataTable results"
                                               role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>User</th>
                                                    <th>Licence plate</th>
                                                    <th>
                                                        Distance travelled <a
                                                                href="{{ route('route.indexDistanceAscending') }}"
                                                                style="margin-left:1%;margin-right:1% "><i
                                                                    class="fa fa-sort-up"></i> </a>
                                                        <a href="{{ route('route.indexDistanceDescending') }}"><i
                                                                    class="fa fa-sort-down"></i> </a>
                                                    </th>
                                                    <th>
                                                        Total cost <a href="{{ route('route.indexCostAscending') }}"
                                                                      style="margin-left:1%;margin-right:1% "><i
                                                                    class="fa fa-sort-up"></i> </a>
                                                        <a href="{{ route('route.indexCostDescending') }}"><i
                                                                    class="fa fa-sort-down"></i> </a>
                                                    </th>
                                                    <th>Cost</th>
                                                    <th>Details</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($routes as $route)
                                                    <tr>
                                                        <td>{{ $route->user->first_name }} {{ $route->user->last_name }} </td>
                                                        <td>{{ $route->car->licence_plate }}</td>
                                                        <td>{{ number_format($route->distance_travelled, 2) }} km
                                                        </td>
                                                        <td>€ {{ number_format($route->total_cost, 2) }}</td>
                                                        <td> {{ $route->cost->name }}</td>
                                                        <td>
                                                            <form role="form" method="GET"
                                                                  action="{{ route('route.details') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $route->id }}">
                                                                <button type="submit" class="btn btn-info"><span
                                                                            class="glyphicon glyphicon-list-alt"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form role="form" method="GET"
                                                                  action="{{ route('route.edit') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $route->id }}">
                                                                <button type="submit" class="btn btn-warning"><span
                                                                            class="glyphicon glyphicon-edit"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form role="form" method="POST"
                                                                  action="{{ URL::route('route.destroy') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $route->id }}">
                                                                <button type="submit" class="btn btn-danger"><span
                                                                            class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">User</th>
                                                    <th rowspan="1" colspan="1">Licence plate</th>
                                                    <th rowspan="1" colspan="1">Distance travelled</th>
                                                    <th rowspan="1" colspan="1">Total cost</th>
                                                    <th rowspan="1" colspan="1">Cost</th>
                                                    <th rowspan="1" colspan="1">Edit</th>
                                                    <th rowspan="1" colspan="1">Delete</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="example2_info" role="status">
                                        </div>
                                    </div>
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