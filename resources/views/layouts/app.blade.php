<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        .navbar-brand {
            font-size: 2vw;
        }
        .navbar-light {
            background: orange;
        }

        .logo {
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
        }

        .nameApp {
            color: #FFF;
        }
        .nameApp2 {
            display: none;
            color: #FFF;
        }

        @media (max-width: 700px){
            .logo {
                display: none;
            }
            .nameApp {
                display: none;
            }
            .nameApp2 {
                display: inline;
                font-size: 2em;
            }
        }

        #nameUser {
            color: #FFF;
        }

        .jumboColorBlue {
            background-color: #98e1b7;
            margin: 10px;
            padding: 20px;
        }
        .jumboColorBlue p {
            margin: 0;
        }

        .jumboColorDark {
            margin: 0px;
            padding: 12px;
            border-radius: 0px;
            opacity: 0.8;
        }

        .jumboColorDark p {
            color: white;
            margin: 0;
        }

        .jumboBox {
            margin: 10px;
            padding: 20px;
            background-color: #1b4b72;
            color: white;
            border-radius: 0px;

        }

        .left {
            margin-right: 20px;
            margin-left: 20px;
        }
        .right {
            margin-right: 20px;
            margin-left: 20px;
        }

        .blue {
            color: #227dc7;
        }
        .orange {
            color: #f6993f;
        }

        .jumbo-1 {
            background-image: url("/images/tecoriginal.jpg");
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: -10px -10px;
        }

        .jumbo-2 {
            background-image: url("/images/tecoriginal.jpg");
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: -10px -10px;
        }

        .jumbo-3 {
            background-image: url("/images/tecoriginal.jpg");
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: -10px -10px;
        }

        .jumbo-4 {
            background-image: url("/images/tecoriginal.jpg");
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: -5px -90px;
        }

        .jumbo-5 {
            background-image: url("/images/tecoriginal.jpg");
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: -5px -90px;
        }

        .div-listado {
            float:left;

            overflow-y: auto;
            height: 800px;
        }
        .form-button {
            display: inline;
            margin: 0;
        }
        </style>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <img class="logo" src="{{asset('images/logo.png')}}" alt="Portada">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="nameApp">{{ config('app.name', 'Laravel') }}</span>
                <span class="nameApp2">Sistema de Seguimiento de Titulaciones</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span id="nameUser">{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</span> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
