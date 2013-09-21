@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('latest_images')

    <div class="container">

        <div class="row">

            @foreach($images as $image)

                <div class="col-sm-2">
                    <a href="{{ route('show_image', array('id' => $image->id)) }}">
                        {{ HTML::image('uploads/' . $image->id . '/' . $image->img_min, $image->img_min, array('class' => 'img-responsive img-thumbnail')) }}
                    </a>
                </div>

            @endforeach

        </div>

    </div>

@stop

@section('content')

    {{ Form::open(array('url' => 'upload', 'method' => 'post', 'id' => 'upload-image', 'enctype' => 'multipart/form-data', 'files' => true)) }}

        <div class="form-group">
            <div id="browse" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-picture"></span>  Select images</div>
        </div>

        {{ Form::file('file[]', array('multiple' => 'multiple', 'id' => 'multiple-files', 'accept' => 'image/*')) }}

        <div id="files"></div>

        <div class="form-group" id="form-buttons">

            <div class="checkbox" style="margin: 20px 10px;">
                <label>
                    {{ Form::hidden('private', 0); }}
                    {{ Form::checkbox('private', 1); }} Check image(s) as private
                </label>
            </div>

            {{ Form::submit('Upload images', array('class' => 'btn btn-success btn-lg btn-block')) }}

            {{ Form::reset('Reset', array('class' => 'btn btn-warning btn-block', 'id' => 'reset')) }}
        </div>

    {{ Form::close() }}

    <div id="notifications">

        @if (Session::has('image-message'))
            <div class="alert {{ Session::get('status') }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('image-message') }}
            </div>
        @endif

        @if (Session::has('files'))

            @foreach (Session::get('files') as $file)
                <div class="alert alert-info">{{ HTML::link('show/' . $file, 'Link to your image.') }}</div>
            @endforeach

        @endif

    </div>

@stop