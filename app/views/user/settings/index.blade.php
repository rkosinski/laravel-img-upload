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
                    Your profile
                </a>
                <a href="#" class="list-group-item">Account settings</a>
                <a href="#" class="list-group-item">Notification history</a>
            </div>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading">Your public profile data</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label for="name" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" placeholder="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-lg-2 control-label">Public e-mail</label>
                            <div class="col-lg-10">
                                <input type="email" name="email" class="form-control" placeholder="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="url" class="col-lg-2 control-label">URL</label>
                            <div class="col-lg-10">
                                <input type="text" name="url" class="form-control" placeholder="{{ Auth::user()->url }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="reset" class="btn btn-warning">Cancel</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@stop

@section('add_script')
    <script>
        $(document).ready(function() {
            $('input').each(function() {
                var placeholder = $(this).attr('placeholder');
                $(this).val(placeholder);
            });
        });
    </script>
@stop