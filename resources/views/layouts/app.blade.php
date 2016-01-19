<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title or 'Todo lists app' }}</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/css/style.css')}}" rel="stylesheet" />

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
                <button type="button" class="menu-trigger btn btn-default" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                </button>
            </div>

        </div>
    </nav>
    <div class="container">
        <div id="menu" class="col-sm-2">
            <div class="row navbar navbar-default">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <ul class="navbar nav nav-pills nav-stacked">
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    </ul>
                @else
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
            @if (!Auth::guest())
                <div class="row navbar navbar-default">
                    <div class="panel-heading">Todo lists</div>
                    <ul class="navbar nav nav-pills nav-stacked">
                        @forelse($lists as $todoList)
                            <li class="list_li">
                                <a @if(isset($list->id) && $todoList->id == $list->id) class="active" @endif href="{{url('/lists')}}/{{$todoList->id}}">
                                    {{$todoList->title}}
                                    <div class="edit_list">
                                        <form id="del_list_{{$todoList->id}}" action="{{url('/lists/delete/')}}/{{$todoList->id}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('delete')}}
                                            <a href="{{url('/lists/edit/')}}/{{$todoList->id}}"><span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                            <a href="#" onclick="return confirmDelete('del_list_{{$todoList->id}}')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </form>

                                    </div>
                                </a>

                            </li>
                        @empty
                            <li><a>No lists</a></li>
                        @endforelse
                    </ul>
                    <div class="col-md-12">
                        <form action="{{url('/lists/add')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-default">
                                    <i class="fa fa-plus"></i>Add list
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-10">
            @include('common.messages')
            <!-- Display Validation Errors -->
            @include('common.errors')
            @yield('content')
        </div>
    </div>
    <script src="{{url('/js/jpanelmenu.min.js')}}"></script>
    <script src="{{url('/js/jrespond.min.js')}}"></script>
    <script src="{{url('/js/script.js')}}"></script>
</body>
</html>
