@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('content')

    <div class="row">

        <div class="col-md-4">
            <div class="list-group">
                {{ HTML::linkRoute('profile_user', 'Your profile', array(), array('class' => 'list-group-item')) }}
                {{ HTML::linkRoute('account_user', 'Account settings', array(), array('class' => 'list-group-item active')) }}
                <a href="#" class="list-group-item">Notification history</a>
            </div>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading">Change account password</div>

                <div class="panel-body">

                    @if($errors->count() > 0)

                        @foreach($errors->all() as $error)

                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ $error }}
                            </div>

                        @endforeach

                    @endif

                    {{ Form::open(array('url' => 'user/account/edit', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

                        <div class="form-group">
                            {{ Form::label('old_password', 'Current password', array('class' => 'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{ Form::password('old_password', array('class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('new_password', 'New password', array('class' => 'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{ Form::password('new_password', array('class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('new_password_confirmation', 'Confirm password', array('class' => 'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{ Form::password('new_password_confirmation', array('class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>

                    {{ Form::close() }}

                </div>

            </div>

            <div class="panel panel-default">

                <div class="panel-heading">Delete account</div>

                <div class="panel-body">

                </div>

            </div>

        </div>

    </div>

@stop

@section('add_script')
@stop