@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cars
                <small>All Cars</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Cars</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">All Cars</h3>
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
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cars as $car)
                                                    <tr>
                                                        <td>{{ $car->user->first_name }} {{ $car->user->last_name }} </td>
                                                        <td>{{ $car->licence_plate }}</td>
                                                        <td>
                                                            <form role="form" method="GET"
                                                                  action="{{ URL::route('car.edit') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $car->id }}">
                                                                <button type="submit" class="btn btn-warning"><span
                                                                            class="glyphicon glyphicon-edit"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form role="form" method="POST"
                                                                  action="{{ URL::route('car.destroy') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $car->id }}">
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