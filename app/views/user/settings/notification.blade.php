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
                {{ HTML::linkRoute('account_user', 'Account settings', array(), array('class' => 'list-group-item')) }}
                {{ HTML::linkRoute('notification_user', 'Latest notifications', array(), array('class' => 'list-group-item active')) }}
                {{ HTML::linkRoute('notification_history', 'Notification history', array(), array('class' => 'list-group-item')) }}
            </div>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading">Latest notifications</div>

                <div class="panel-body">

                    <div class="alert alert-info" id="alert">There are no notifications to show.</div>

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Notification</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- */$i=1;/* --}}

                                @foreach ($notifications as $notification)

                                <tr>
                                    @if ($notification->images->user_id === Auth::user()->id)
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $notification->users->username }}</td>
                                        <td>User voted on your image.</td>
                                        <td>
                                            {{ Form::open(array('url' => 'user/notification/read', 'method' => 'post', 'role' => 'form')) }}
                                                <a href="{{ route('show_image', array('id' => $notification->images->id)) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Show image</a>
                                                {{ Form::hidden('id', $value = $notification->id) }}
                                                {{ Form::hidden('user_id', $value = $notification->images->user_id) }}
                                                 <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Mark as read</button>
                                            {{ Form::close() }}
                                        </td>
                                    @endif
                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="iterator">{{ $i }}</div>

@stop

@section('add_script')
    <script>
    $(document).ready(function() {
        var i = $('#iterator');
        var alert = $('#alert');
        i.hide();
        alert.hide();
        if (i.text() == 1) {
            $('.table-responsive').hide();
            alert.show();
        }
    });
    </script>
@stop