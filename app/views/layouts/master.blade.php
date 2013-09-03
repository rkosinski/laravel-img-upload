<!DOCTYPE html>
<html>
<head>
    <title>Wrzuć - {{ $title }} - rkosinski.pl</title>
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
                {{ HTML::linkRoute('main', 'Wrzuć', array(), array('class' => 'navbar-brand')) }}
            </div>

            <div class="navbar-collapse collapse">

                @section('main_menu')

                <ul class="nav navbar-nav">
                    <li>{{ HTML::linkRoute('images', 'Przeglądaj') }}</li>
                </ul>

                @show

                @section('login')

                    @if(Auth::check())

                    <div class="navbar-right">

                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>{{ HTML::linkRoute('images_user', 'Moje zdjęcia') }}</li>
                                    <li class="divider"></li>
                                    <li>{{ HTML::linkRoute('logout', 'Wyloguj się') }}</li>
                                </ul>
                            </li>
                        </ul>

                    </div>

                    @endif

                @show

            </div><!--/.navbar-collapse -->

        </div> <!-- end of container -->

    </div> <!-- end of navbar navbar-default navbar-static-top -->

    <div class="container">

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
                        <h3 class="panel-title">Panel logowania</h3>
                    </div>
                    <div class="panel-body">

                        {{ Form::open(array('url' => 'login', 'method' => 'post', 'class' => '', 'id' => 'login-form')) }}

                            <div class="alert alert-danger" id="login-alert"></div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="email">Adres e-mail</label>
                                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'E-mail', 'type' => 'email', 'required')) }}
                                  </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Hasło</label>
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Hasło', 'required')) }}
                            </div>

                            <button type="submit" class="btn btn-success" id="button-login">Zaloguj się</button>

                            {{ HTML::linkRoute('show_register', 'Rejestracja', array(), array('class' => 'btn btn-warning'))}}

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
        $('#myTab a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
        $(".delete-button").click(function(){
            if (!confirm("Czy chcesz usunąć to zdjęcie?")){
              return false;
            }
        });
    </script>
</body>
</html>
