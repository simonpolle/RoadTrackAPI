@extends('layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 923px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Routes
                <small>Create route</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Routes</a></li>
                <li class="active">Create</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create route</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ URL::route('route.store') }}">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="user_id">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputDistance">Distance travelled</label>
                                    <input type="number" min="1" max="10000" class="form-control" id="distance_travelled"
                                           name="distance_travelled"
                                           placeholder="distance travelled"
                                           style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"
                                           autocomplete="off"
                                           pattern="[0-9]+([\.,][0-9]+)?"
                                           step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="InputTotalCost">Total cost</label>
                                    <input type="number" min="1" max="1000" class="form-control" id="total_cost"
                                           name="total_cost"
                                           placeholder="total cost"
                                           style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"
                                           autocomplete="off"
                                           pattern="[0-9]+([\.,][0-9]+)?"
                                           step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="InputCost">Cost</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="cost_id">
                                        @foreach($costs as $cost)
                                            <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <!-- /.box-body -->
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col -->
            <!-- /.row -->
        </section>
    </div>
@endsection