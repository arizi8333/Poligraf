<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PT Poligraf Indonesia') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
                font-family: 'Nunito', sans-serif;
                background-image: url("Logo/Home.png");
                
                background-repeat: no-repeat; /* Do not repeat the image */
                background-size: cover; /* Resize the background image to cover the entire container */
                background-color: #cccccc;
            }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
         
                <!-- <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <b>POLIGRAF</b>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class=" navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('register') }}"><b>{{ __('Register') }}</b></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown text-dark" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b>{{ Auth::user()->name }}</b>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <b>{{ __('Logout') }}</b>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
          
        </nav>
        <div class="row m-0 p-0">
            <div class="col-6 mr-0 pr-0">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
            <div class="col-6 mt-4 pt-4 mr-0 pr-0">
                <div class="text-center">
                    <div class="pt-2" style="color: #455FC1;text-shadow: 5px 7px 28px #000000;"><h2><b>ASPS GLOBAL</b></h2></div>
                    <div class="pt-2" style="color: #455FC1;text-shadow: 5px 7px 28px #000000;"><h1><b>Arizona School Of Polygraph Science</b></h1></div>
                    <div class="pt-2" style="color: #455FC1;text-shadow: 5px 7px 28px #000000;"><h4><b>Since 1985 Simplifying Polygraph</b></h4></div>
                    <div class="pt-2" style="color: #455FC1;text-shadow: 5px 7px 28px #000000;"><h4><b>The information at your fingertips</b></h4></div><br>
                    <img src="{{url("Logo/logo-2.png")}}" width="23%">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
