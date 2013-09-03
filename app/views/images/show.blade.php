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

@stop