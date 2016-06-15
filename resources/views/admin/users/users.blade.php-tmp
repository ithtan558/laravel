@extends('admin.layouts.master')
@section('title', 'SB Admin 2 - Bootstrap Admin Theme')
@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List user</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row" ng-controller="UsersController">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Avatar</th>
                                    <th>Full name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listUsers as $key => $user)
                                <tr class="@if ($key%2==0)  odd @else even @endif gradeX">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->avatar}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="center">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                        <a href="{{ route('edit_user', $user->id) }}"><button type="button" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;"><span class="fa fa-pencil"></span></button></a>
                                            <button type="button" class="tabledit-delete-button btn btn-sm btn-default" style="float: none;"><span class="fa fa-trash"></span></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection
@section('javascriptDown')
	<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
@endsection