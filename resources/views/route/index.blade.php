@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Routes
                <small>All Routes</small>
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
                            <h3 class="box-title">All Routes</h3>
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
                                        <table id="example2" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="example2_info">
                                            <thead>
                                            <tr role="row">
                                                <th>
                                                    User
                                                </th>
                                                <th>
                                                    Licence plate
                                                </th>
                                                <th>
                                                    Distance travelled
                                                </th>
                                                <th>
                                                    Total cost
                                                </th>
                                                <th>
                                                    Edit
                                                </th>
                                                <th>
                                                    Delete
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($routes as $route)
                                                <tr>
                                                    <td>{{ $route->user->first_name }} {{ $route->user->last_name }} </td>
                                                    <td>{{ $route->car->licence_plate }}</td>
                                                    <td>{{ $route->distance_travelled }}</td>
                                                    <td>{{ $route->total_cost }}</td>
                                                    <td>
                                                        <form role="form" method="POST"
                                                              action="{{ route('route.edit') }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $route->id }}">
                                                            <button type="submit" class="btn btn-warning"><span
                                                                        class="glyphicon glyphicon-edit"></span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form role="form" method="POST"
                                                              action="{{ URL::route('route.destroy') }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $route->id }}">
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
                                                <th rowspan="1" colspan="1">Edit</th>
                                                <th rowspan="1" colspan="1">Delete</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">Showing 1 to 10 of 57 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button previous disabled" id="example2_previous"><a
                                                            href="#" aria-controls="example2" data-dt-idx="0"
                                                            tabindex="0">Previous</a>
                                                </li>
                                                <li class="paginate_button active"><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="1" tabindex="0">1</a>
                                                </li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                                                data-dt-idx="2" tabindex="0">2</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                                                data-dt-idx="3" tabindex="0">3</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                                                data-dt-idx="4" tabindex="0">4</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                                                data-dt-idx="5" tabindex="0">5</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                                                data-dt-idx="6" tabindex="0">6</a></li>
                                                <li class="paginate_button next" id="example2_next"><a href="#"
                                                                                                       aria-controls="example2"
                                                                                                       data-dt-idx="7"
                                                                                                       tabindex="0">Next</a>
                                                </li>
                                            </ul>
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