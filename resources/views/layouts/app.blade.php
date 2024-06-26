<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
                <!-- CSRF Token -->
                <meta content="{{ csrf_token() }}" name="csrf-token">
                    <title>
                        {{ config('app.name', 'Laravel') }}
                    </title>
                    <!-- Scripts -->
                    <script defer="" src="{{ asset('js/app.js') }}">
                    </script>
                    <script src="@yield('script0')" type="text/javascript">
                    </script>
                    <!-- Fonts -->
                    <link href="//fonts.gstatic.com" rel="dns-prefetch">
                        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
                            <!-- Styles -->
                            {{--
                            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                                --}}
                                <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
                                    <!-- Custom styles for this template -->
                                    <link href="{{ asset('css/open-iconic/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
                                        <link href="@yield('style')" rel="stylesheet">
                                            <style>
                                                #customfooter {
                                                   position:fixed;
                                                   left:0px;
                                                   bottom:0px;
                                                   height:30px;
                                                   width:100%;
                                                   background:#a4c639;
                                               }
                                               @yield('style')
                                            </style>
                                            @yield('script-inline')
                                        </link>
                                    </link>
                                </link>
                            </link>
                        </link>
                    </link>
                </meta>
            </meta>
        </meta>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        @guest 
                        {{ config('app.name', 'Laravel') }}
                    @else
                        {{ Auth::user()->name }}
                    @endguest
                    </a>
                    <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
                        <span class="navbar-toggler-icon">
                        </span>
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
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Registrarse') }}
                                </a>
                            </li>
                            @endif
                        @else
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST">
                                @csrf
                            </form>
                            @include('includes.menu')
                        @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-1">
                {{--@yield('content')--}}
                <div class="container">
                    <div class="row">
                        {{--
                        <div class="col-lg-3">
                            --}}
                        {{--@include('includes.menu')--}}
                    {{--
                        </div>
                        --}}
                        <!-- /.col-lg-3 -->
                        <div class="col-lg-12 col-md-8 col-sm-6 col-xs-12">
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{session('warning')}}
                                </div>
                            @endif

                            @if (session('notification'))
                                <div class="alert alert-success">
                                    {{session('notification')}}
                                </div>
                            @endif

                            @section('content')
                            @show
                        </div>
                        <!-- /.col-lg-9 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </main>
        </div>
        <footer class="py-1 bg-primary" id="customfooter">
            <div class="container">
                <p class="text-center align-middle text-white">
                    Copyright © CONS 2019
                </p>
            </div>
        </footer>
        <script src="@yield('script')">
        </script>
        <script src="@yield('script2')">
        </script>
    </body>
</html>
