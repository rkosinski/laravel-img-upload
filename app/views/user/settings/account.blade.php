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
                {{ HTML::linkRoute('notification_user', 'Latest notifications', array(), array('class' => 'list-group-item')) }}
                {{ HTML::linkRoute('notification_history', 'Notification history', array(), array('class' => 'list-group-item')) }}
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
                                <button type="submit" class="btn btn-success">Update password</button>
                            </div>
                        </div>

                    {{ Form::close() }}

                </div>

            </div>

            <div class="panel panel-default">

                <div class="panel-heading">Delete account</div>

                <div class="panel-body">

                    {{ Form::open(array('url' => 'user/account/delete', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

                        <div class="form-group">
                            {{ Form::label('password', 'Password', array('class' => 'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{ Form::password('password', array('class' => 'form-control', 'id' => 'delete-password')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <button type="submit" class="btn btn-danger" id="delete-button">Delete account</button>
                            </div>
                        </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

@stop

@section('add_script')
    <script>
        $(document).ready(function() {
            $('#delete-button').click(function(event) {
                if ($('#delete-password').val().length !== 0) {
                    if (! confirm('You want to delete this account?')){
                      return false;
                    }
                } else {
                    event.preventDefault();
                }
            })
        });
    </script>
@stop