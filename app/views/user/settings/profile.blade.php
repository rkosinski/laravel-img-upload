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
                {{ HTML::linkRoute('profile_user', 'Your profile', array(), array('class' => 'list-group-item active')) }}
                {{ HTML::linkRoute('account_user', 'Account settings', array(), array('class' => 'list-group-item')) }}
                {{ HTML::linkRoute('notification_user', 'Latest notifications', array(), array('class' => 'list-group-item')) }}
                {{ HTML::linkRoute('notification_history', 'Notification history', array(), array('class' => 'list-group-item')) }}
            </div>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading">Your public profile data</div>

                <div class="panel-body">

                    @if($errors->count() > 0)

                        @foreach($errors->all() as $error)

                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ $error }}
                            </div>

                        @endforeach

                    @endif

                    {{ Form::open(array('url' => 'user/profile/edit', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name', array('class' => 'col-lg-2 control-label')) }}
                            <div class="col-lg-10">
                                {{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => Auth::user()->name)) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Public e-mail', array('class' => 'col-lg-2 control-label')) }}
                            <div class="col-lg-10">
                                {{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => Auth::user()->email)) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('url', 'URL', array('class' => 'col-lg-2 control-label')) }}
                            <div class="col-lg-10">
                                {{ Form::text('url', '', array('class' => 'form-control', 'placeholder' => Auth::user()->url)) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-success">Update data</button>
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
            $('input').each(function() {
                var placeholder = $(this).attr('placeholder');
                $(this).val(placeholder);
            });
        });
    </script>
@stop