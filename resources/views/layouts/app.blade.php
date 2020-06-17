<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Algolia --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <img class="logo" src="https://png2.cleanpng.com/sh/b260419f8db2c75b86cbbd4d0be6fe75/L0KzQYm3VsA5N5NrjZH0aYP2gLBuTfFqepNzep91b3fyPcTojr1nepJze9t8Y3AwhMPolvVtNZl0jNd1LXHsgrP1gr1td5h0RadrMXG1cYPqVsJnbpM7RqcENEW2QYe3UcUzQGU5SaUDOESzRYa1kP5o/kisspng-airbnb-logo-san-francisco-travel-hotel-airbnb-logo-5b1a2a2c62ffb6.5945316015284413884055.png" alt="">
                    </ul>
                    <style>
                      .logo {
                        width: 10%;
                      }
                    </style>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('upr.homes.index') }}">
                                        Dashboard
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
        @yield('script')
    </div>

    {{-- algolia --}}
   <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
   <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearchLite.min.js"></script>
   <script src="https://cdn.jsdelivr.net/instantsearch.js/2.10.1/instantsearch.min.js"></script>
   <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesAutocompleteDataset.min.js"></script>
</body>
</html>
