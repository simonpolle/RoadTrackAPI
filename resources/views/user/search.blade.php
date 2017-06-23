@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Search users</small>
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
                            <h3 class="box-title">Search users</h3>
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
                                                    <th>Picture</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Company</th>
                                                    <th>Details</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </td>
                                                        <td>
                                                            <img src="{{$user->image }}"
                                                                 alt="User Image" width="50" height="50">
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->role->name }}</td>
                                                        @if($user->company != null)
                                                            <td>{{ $user->company->name }}</td>
                                                        @else
                                                            <td>None</td>
                                                        @endif
                                                        <td>
                                                            <form role="form" method="GET"
                                                                  action="{{ route('user.details') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $user->id }}">
                                                                <button type="submit" class="btn btn-info"><span
                                                                            class="glyphicon glyphicon-list-alt"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form role="form" method="GET"
                                                                  action="{{ URL::route('user.edit') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                <button type="submit" class="btn btn-warning"><span
                                                                            class="glyphicon glyphicon-edit"></span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form role="form" method="POST"
                                                                  action="{{ URL::route('user.destroy') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
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
                                                    <th rowspan="1" colspan="1"></th>
                                                    <th rowspan="1" colspan="1">Email</th>
                                                    <th rowspan="1" colspan="1">Role</th>
                                                    <th rowspan="1" colspan="1">Company</th>
                                                    <th rowspan="1" colspan="1">Details</th>
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