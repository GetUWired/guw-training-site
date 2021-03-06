<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet"
          type="text/css"/>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'GUW Training') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'GUW Training') }}
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Languages <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/problems/all') }}">All</a></li>
                                <li><a href="{{ url('/problems/php') }}">PHP</a></li>
                                <li><a href="{{ url('/problems/jquery') }}">jQuery</a></li>
                                <li><a href="{{ url('/problems/javascript') }}">Javascript</a></li>
                                <li><a href="{{ url('/problems/html') }}">HTML</a></li>
                                <li><a href="{{ url('/problems/css') }}">CSS</a></li>
                                <li><a href="{{ url('/problems/sql') }}">SQL</a></li>
                                <li><a href="{{ url('/problems/json') }}">JSON</a></li>
                                <li><a href="{{ url('/problems/xml') }}">XML</a></li>
                                <li><a href="{{ url('/problems/infusionsoft') }}">Infusionsoft</a></li>
                                <li><a href="{{ url('/problems/wordpress') }}">WordPress</a></li>
                            </ul>
                        </li>
                        <li><a href="/sets">Problem Sets</a></li>
                        <li><a href="/leaderboard">Leaderboard</a></li>
                    @endauth
                </ul>
                
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <img class="avatar" src="https://api.adorable.io/avatars/25/<?= str_random(15);?>.png"
                                     alt="Avatar"> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->user_level == 10)
                                    <li><a href="/add-problem">Add Problem</a></li>
                                    <li><a href="/sets/create">Add Set</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $('textarea').summernote({
            codemirror: {
                theme: 'material'
            }
        })
    })
</script>
@include('layouts.flash-message')
</body>
</html>
