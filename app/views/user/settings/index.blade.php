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
                <a href="#" class="list-group-item active">
                    Profile
                </a>
                <a href="#" class="list-group-item">Account settings</a>
                <a href="#" class="list-group-item">Notification history</a>
            </div>
        </div>

    </div>

@stop