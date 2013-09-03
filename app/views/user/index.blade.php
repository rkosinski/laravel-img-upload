@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('content')

    <div class="row">

        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#public">Publiczne</a></li>
                <li><a href="#private">Prywatne</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="public" style="margin-bottom: 30px;">

                    @foreach($images as $image)

                        @if ($image->private == 0)
                        <div class="col-sm-2">
                            <a href="{{ route('show_image', array('id' => $image->id)) }}">
                                {{ HTML::image('uploads/' . $image->id . '/' . $image->img_min, $image->img_min, array('class' => 'img-responsive img-thumbnail', 'style' => 'margin-bottom: 0;')) }}
                            </a>
                            {{ Form::open(array('url' => 'user/image/destroy/' . $image->id, 'method' => 'delete')) }}
                            {{ Form::submit('Usuń', array('class' => 'delete-button btn btn-danger btn-sm btn-block', 'style' => 'margin: 10px 0')) }}
                            {{ Form::close() }}
                        </div>
                        @endif

                    @endforeach

                </div>

                <div class="tab-pane" id="private" style="margin-bottom: 30px;">

                    @foreach($images as $image)

                        @if ($image->private == 1)
                        <div class="col-sm-2">
                            <a href="{{ route('show_image', array('id' => $image->id)) }}">
                                {{ HTML::image('uploads/' . $image->id . '/' . $image->img_min, $image->img_min, array('class' => 'img-responsive img-thumbnail', 'style' => 'margin-bottom: 0;')) }}
                            </a>
                            {{ Form::open(array('url' => 'user/image/destroy/' . $image->id, 'method' => 'delete')) }}
                            {{ Form::submit('Usuń', array('class' => 'delete-button btn btn-danger btn-sm btn-block', 'style' => 'margin: 10px 0')) }}
                            {{ Form::close() }}
                        </div>
                        @endif

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@stop