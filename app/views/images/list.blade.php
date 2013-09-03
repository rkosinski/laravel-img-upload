@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('content')

    <div class="row">

        @foreach($images as $image)

            <div class="col-sm-2">
                <a href="{{ route('show_image', array('id' => $image->id)) }}">
                    {{ HTML::image('uploads/' . $image->id . '/' . $image->img_min, $image->img_min, array('class' => 'img-responsive img-thumbnail')) }}
                </a>
            </div>

        @endforeach

    </div>

@stop