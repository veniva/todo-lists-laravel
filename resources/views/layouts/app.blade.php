<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo task lists</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{url('/css/style.css')}}" rel="stylesheet" />

            <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="menu-trigger btn btn-default">
                    <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                </button>
            </div>
            <div id="menu">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @include('common.messages')
        @yield('content')
    </div>
    <script src="{{url('/js/jpanelmenu.min.js')}}"></script>
    <script src="{{url('/js/jrespond.min.js')}}"></script>
    <script type="text/javascript">
        var jPM = $.jPanelMenu();
        var jRes = jRespond([
            {
                label: 'small',
                enter: 0,
                exit: 800
            },{
                label: 'large',
                enter: 800,
                exit: 10000
            }
        ]);

        jRes.addFunc({
            breakpoint: 'small',
            enter: function() {
                jPM.on();
                $('#menu').css({display:'none'});
                $('.menu-trigger').css({display:'block'})
                $('#jPanelMenu-menu').addClass('navbar navbar-default')
            },
            exit: function() {
                jPM.off();
                $('#menu').css({display:'block'});
                $('.menu-trigger').css({display:'none'})
            }
        });
    </script>
</body>
</html>
