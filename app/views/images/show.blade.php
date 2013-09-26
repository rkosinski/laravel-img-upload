@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('content')

    <a href="{{ URL::to('uploads/' . $image->id . '/' . $image->img_big) }}" title="{{ $image->img_big }}">
        {{ HTML::image('uploads/' . $image->id . '/' . $image->img_big, $image->img_big, array('class' => 'img-responsive img-thumbnail', 'style' => 'display: block; margin: 0 auto;')) }}
    </a>

    <div class="col-md-8 centered clearfix">
        <div class="col-lg-12">
            <div>
                <div class="well">

                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: {{ $votes['good_percent'] }}%" data-toggle="tooltip" title="{{ $votes['good_votes'] }}"></div>
                        <div class="progress-bar progress-bar-danger" style="width: {{ $votes['bad_percent'] }}%" data-toggle="tooltip" title="{{ $votes['bad_votes'] }}"></div>
                    </div>

                    <div class="alert alert-danger" id="vote-alert"></div>

                    @if ($votes['auth'])
                        <a href="{{ URL::to('vote/' . $image->id . '/1') }}" class="btn btn-success btn-sm vote" disabled="disabled"><span class="glyphicon glyphicon-hand-up"></span></a> <a href="{{ URL::to('vote/' . $image->id . '/0') }}" class="btn btn-danger btn-sm vote" disabled="disabled"><span class="glyphicon glyphicon-hand-down"></span></a>
                    @else
                        <a href="{{ URL::to('vote/' . $image->id . '/1') }}" class="btn btn-success btn-sm vote"><span class="glyphicon glyphicon-hand-up"></span></a> <a href="{{ URL::to('vote/' . $image->id . '/0') }}" class="btn btn-danger btn-sm vote"><span class="glyphicon glyphicon-hand-down"></span></a>
                    @endif

                    <a class="btn btn-default btn-sm" disabled="disabled" href="#">
                        <span class="glyphicon glyphicon-user"></span> {{ $user_image }}
                    </a>

                    <a class="btn btn-default btn-sm" disabled="disabled" href="#">
                        <span class="glyphicon glyphicon-calendar"></span> <i>{{ date_format($image->created_at, 'd-m-Y') }}</i>
                    </a>

                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-12">
                <label for="disabledTextInput">Link to image</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Request::url() }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-12">
                <label for="disabledTextInput">Link to fullscreen image</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ URL::to('uploads/' . $image->id . '/' . $image->img_big) }}">
            </div>
        </div>
    </div>

@stop

@section('add_script')
    {{ HTML::script('assets/js/vote.ajax.js') }}
    <script>
        $(document).ready(function() {
            $('input#disabledTextInput').val(function() {
                return $(this).attr('placeholder');
            });

            $('.progress-bar').mouseover(function() {
                $(this).tooltip();
            });
        });
    </script>
@stop