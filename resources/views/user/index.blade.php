@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>All users</small>
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
                            <h3 class="box-title">All users</h3>
                            <h7><a href="{{ route('user.pdf',['download'=>'pdf']) }}">Download PDF</a></h7>
                            <h7><a href="{{ route('user.excel') }}">Download Excel</a></h7>
                            <div class="pull-right">
                                <form role="form" method="GET" action="{{ URL::route('user.search') }}">
                                    <button type="submit" class="btn btn-block btn-default btn-flat">Search</button>
                                </form>
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
                                        <table id="example2" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>
                                                        User <a href="{{ route('user.indexNameAscending') }}"
                                                                style="margin-left:1%;margin-right:1% "><i
                                                                    class="fa fa-sort-up"></i> </a>
                                                        <a href="{{ route('user.indexNameDescending') }}"><i
                                                                    class="fa fa-sort-alpha-desc"></i> </a>
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th>
                                                        Email <a href="{{ route('user.indexEmailAscending') }}"
                                                                 style="margin-left:1%;margin-right:1% "><i
                                                                    class="fa fa-sort-up"></i> </a>
                                                        <a href="{{ route('user.indexEmailDescending') }}"><i
                                                                    class="fa fa-sort-alpha-desc"></i> </a>
                                                    </th>
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
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">Showing 1 to 10 of {{ $users->count() }} entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <?php echo $users->render(); ?>
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