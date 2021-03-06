@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cars
                <small>Search Companies</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Companies</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Search Companies</h3>
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
                                                    <th>User (Admin)</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>VAT Number</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($companies as $company)
                                                    <tr>
                                                        <td>{{ $company->user->first_name }} {{ $company->user->last_name }}</td>
                                                        <td>{{ $company->name }}</td>
                                                        <td>{{ $company->street }} {{ $company->number }} {{ $company->postal_code }} {{ $company->country->name }}</td>
                                                        <td>{{ $company->vat_number }}</td>
                                                        <td>
                                                            <form role="form" method="GET"
                                                                  action="{{ URL::route('company.edit') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $company->id }}">
                                                                <button type="submit" class="btn btn-warning"><span
                                                                            class="glyphicon glyphicon-edit"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form role="form" method="POST"
                                                                  action="{{ URL::route('company.destroy') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $company->id }}">
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
                                                    <th rowspan="1" colspan="1">User (Admin)</th>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Address</th>
                                                    <th rowspan="1" colspan="1">VAT Number</th>
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