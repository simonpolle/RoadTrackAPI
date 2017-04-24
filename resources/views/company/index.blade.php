@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cars
                <small>All Companies</small>
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
                            <h3 class="box-title">All Companies</h3>
                            <h7><a href="{{ route('company.pdf',['download'=>'pdf']) }}">Download PDF</a></h7>
                            <h7><a href="{{ route('company.excel') }}">Download Excel</a></h7>
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
                                                    User (Admin)
                                                </th>
                                                <th>
                                                    Name <a href="{{ route('company.indexNameAscending') }}" style="margin-left:1%;margin-right:1% "><i class="fa fa-sort-up"></i> </a>
                                                    <a href="{{ route('company.indexNameDescending') }}"><i class="fa fa-sort-alpha-desc"></i> </a>
                                                </th>
                                                <th>
                                                    Address <a href="{{ route('company.indexAddressAscending') }}" style="margin-left:1%;margin-right:1% "><i class="fa fa-sort-up"></i> </a>
                                                    <a href="{{ route('company.indexAddressDescending') }}"><i class="fa fa-sort-alpha-desc"></i> </a>
                                                </th>
                                                <th>
                                                    VAT Number
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
                                            @foreach($companies as $company)
                                                <tr>
                                                    <td>{{ $company->user->first_name }} {{ $company->user->last_name }}</td>
                                                    <td>{{ $company->name }}</td>
                                                    <td>{{ $company->street }} {{ $company->number }} {{ $company->postal_code }} {{ $company->country }}</td>
                                                    <td>{{ $company->vat_number }}</td>
                                                    <td>
                                                        <form role="form" method="POST" action="{{ URL::route('company.edit') }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $company->id }}">
                                                            <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form role="form" method="POST" action="{{ URL::route('company.destroy') }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $company->id }}">
                                                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
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
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">Showing 1 to 10 of 57 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <?php echo $companies->render(); ?>
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