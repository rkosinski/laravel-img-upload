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
            <span class="glyphicon glyphicon-user"></span>
            @if ($image->user_id == 0)
                <i>anynomous</i>
            @else
                <i>{{ $image->users->name }}</i>
            @endif
            <br><br>
            <p><span class="glyphicon glyphicon-calendar"></span> <i>{{ date_format($image->created_at, 'd-m-Y') }}</i></p>
        </div>
        <br class="clear">

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
    <script>
        $(document).ready(function() {
            $("input#disabledTextInput").val(function() {
                return $(this).attr('placeholder');
            });
        });
    </script>
@stop