<!DOCTYPE html>
<html>
<head>
    <title>Img-upload - {{ $title }} - rkosinski.pl</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/custom.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        {{ HTML::script('assets/js/html5shiv.js') }}
        {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
</head>
<body>

    <div class="navbar navbar-default navbar-static-top">

        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{ HTML::linkRoute('main', 'Img-upload', array(), array('class' => 'navbar-brand')) }}
            </div>

            <div class="navbar-collapse collapse">

                @section('main_menu')

                <ul class="nav navbar-nav">
                    <li>{{ HTML::linkRoute('images', 'Public images') }}</li>
                </ul>

                @show

                @section('login')

                    @if(Auth::check())

                    <div class="navbar-right">

                        {{-- */$i=0;/* --}}

                        @foreach ($notifications as $notification)

                            @if ($notification->images->user_id === Auth::user()->id)

                                {{-- */$i++;/* --}}

                            @endif

                        @endforeach

                        <ul class="nav navbar-nav">
                            <li>{{ HTML::decode(HTML::linkRoute('notification_user', 'Latest notifications <span class="badge">' . $i . '</span>')) }}</li>
                        </ul>

                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->username }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>{{ HTML::linkRoute('images_user', 'My images') }}</li>
                                    <li>{{ HTML::linkRoute('profile_user', 'Account settings') }}</li>
                                    <li class="divider"></li>
                                    <li>{{ HTML::linkRoute('logout', 'Logout') }}</li>
                                </ul>
                            </li>
                        </ul>

                    </div>

                    @endif

                @show

            </div><!--/.navbar-collapse -->

        </div> <!-- end of container -->

    </div> <!-- end of navbar navbar-default navbar-static-top -->

    <div class="container" id="main">

        <div class="row clearfix">

            @if(! Auth::check())
            <div class="col-md-8">
            @else
            <div class="col-md-12">
            @endif

                @if (Session::has('message'))
                    <div class="alert {{ Session::get('status') }} alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif

                @yield('content')

            </div>

            @if(! Auth::check())

            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login panel</h3>
                    </div>
                    <div class="panel-body">

                        {{ Form::open(array('url' => 'login', 'method' => 'post', 'class' => '', 'id' => 'login-form')) }}

                            <div class="alert alert-danger" id="login-alert"></div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="email">E-mail adress</label>
                                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'E-mail', 'type' => 'email', 'required')) }}
                                  </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'required')) }}
                            </div>

                            <button type="submit" class="btn btn-success" id="button-login">Login</button>

                            {{ HTML::linkRoute('show_register', 'Register', array(), array('class' => 'btn btn-warning'))}}

                        {{ Form::close() }}

                    </div>
                </div>

            </div>

            @endif

        </div>

    </div>

    <br class="clear" />

    @section('latest_images')
    @show
    <hr />
    <div class="container">
        <p style="text-align: center;">Copyright by Radosław Kosiński {{ date('Y') }}. Visit {{ HTML::link('http://rkosinski.pl/', 'rkosinski.pl') }} for more.</p>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('http://code.jquery.com/jquery.js') }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    <!-- Logowanie - ajax -->
    {{ HTML::script('assets/js/login.ajax.js') }}
    <!-- Wrzucanie zdjec -->
    {{ HTML::script('assets/js/img.send.js') }}
    <!-- Taby i confirm delete-->
    <script>
        $(document).ready(function() {
            var main = $('#main');
            main.hide();
            main.fadeIn(800);
        });
    </script>
    @section('add_script')
    @show
</body>
</html>
