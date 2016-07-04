@extends('admin.layouts.app')
@section('title', 'SB Admin 2 - Bootstrap Admin Theme')
@section('javascriptUp')
    <!-- App js angular Core JavaScript -->
    <script src="<?= asset('public/app/controllers/users.js') ?>"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add user</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row" ng-controller="UsersController">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Here's user's information
                </div>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form name="frmAddUser" method="POST" novalidate="" action="{{ url(Lang::getLocale().'/admin/users/add-user') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                    <label>{{ trans('admin/users/users.type_user') }}</label><span class="required-field">*</span>
                                    <select class="form-control" name="role_id">
                                        <option value="">{{ trans('public.option_default') }}</option>
                                        @foreach ($listRoles as $role)
                                            <option value="{{ $role->id }}" @if (Input::old('role_id') == $role->id) selected="selected" @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>{{ trans('admin/users/users.name') }}</label><span class="required-field">*</span>
                                    <input class="form-control" placeholder="Type your full name" name="name" id="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>{{ trans('admin/users/users.email') }}</label><span class="required-field">*</span>
                                    <input class="form-control" placeholder="Type your email" type="email" name="email" id="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>{{ trans('admin/users/users.password') }}</label><span class="required-field">*</span>
                                    <input class="form-control" placeholder="Type your password" name="password" id="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('admin/users/users.avatar') }}</label>
                                    <input type="file">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection