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

                    <p>
                        @foreach ($notifications as $notification)

                            @if ($notification->images->user_id === Auth::user()->id)
                                <p>User <b>{{ $notification->users->username }}</b> voted on your image
                                    (<a href="{{ route('show_image', array('id' => $notification->images->id)) }}">Link</a>)
                                </p>
                            @endif

                        @endforeach

                    </p>

                </div>

            </div>

        </div>

    </div>

@stop

@section('add_script')
@stop