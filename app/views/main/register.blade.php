@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('content')

    @if($errors->count() > 0)

        @foreach($errors->all() as $error)

            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $error }}
            </div>

        @endforeach

    @endif

    {{ Form::open(array('url' => 'register-user', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

    <div class="form-group">
        {{ Form::label('email', 'Adres e-mail *', array('class' => 'col-lg-4 control-label')) }}
        <div class="col-lg-8">
            {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('name', 'Imię i nazwisko', array('class' => 'col-lg-4 control-label')) }}
        <div class="col-lg-8">
            {{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Imię i nazwisko')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Hasło *', array('class' => 'col-lg-4 control-label')) }}
        <div class="col-lg-8">
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Hasło')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('password_confirmation', 'Potwierdzenie hasła *', array('class' => 'col-lg-4 control-label')) }}
        <div class="col-lg-8">
            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Potwierdzenie hasła')) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button type="submit" class="btn btn-success">Rejestracja</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </div>
    </div>

    {{ Form::close() }}

@stop