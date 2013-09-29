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
                {{ HTML::linkRoute('notification_user', 'Notification history', array(), array('class' => 'list-group-item active')) }}
            </div>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading">Notification history</div>

                <div class="panel-body">

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
                                        <td><a href="{{ route('show_image', array('id' => $notification->images->id)) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Show image</a>
                                         <a href="#" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Mark as read</a></td>
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

@stop

@section('add_script')
@stop