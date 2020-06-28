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

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

    {{-- Algolia --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
          <style>
            .navbar {
              position: fixed;
              width: 100vw;
              z-index: 999;
              height: 70px;
            }
            .mr-auto img {
              width: 100px;
            }
          </style>
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
                      <img class="logo" src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2Fthumb%2F6%2F69%2FAirbnb_Logo_B%25C3%25A9lo.svg%2F220px-Airbnb_Logo_B%25C3%25A9lo.svg.png&f=1&nofb=1" alt="">
                    </ul>
                    <style>
                      .logo {
                        width: 10%;
                      }
                    </style>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <style>
                          .nav__link:hover::after {
                              -webkit-transform: scaleX(1);
                              transform: scaleX(1);
                            }

                          .nav__link--btn {
                            border: 1.5px solid currentColor;
                            border-radius: 2em;
                            margin-left: 1em;
                            transition: background 250ms ease-in-out;
                            letter-spacing: 1px;
                            padding: 0.75em 1.5em;
                          }

                          .nav__link--btn:hover {
                            background: blue;
                            color: white;
                            border-color: blue;
                            text-decoration: none;
                          }

                          .nav__link--btn::after {
                            display: none;
                          }

                          .nav__link--btn--highlight {
                            background: limegreen;
                            border-color: limegreen;
                            color: #333;
                          }

                          .nav__link--btn--highlight:hover {
                            background: blue;
                            border-color: blue;
                            text-decoration: none;
                          }
                        </style>
                        @guest
                            <li class="nav-item">
                              <a class="nav__link nav__link--btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav__link nav__link--btn nav__link--btn--highlight" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"><i class="fab fa-airbnb"></i></span>
                                </a>
                                <style>
                                  .fa-airbnb {
                                    color: #ff5a5e;
                                    font-size: 30px;
                                    font-weight: bolder;
                                  }
                                </style>
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
    </div>
    @include('partials.footer')

    {{-- segnaposto riempibile nelle varie view --}}
    @yield('script')
    {{-- algolia --}}
   <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
   <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearchLite.min.js"></script>
   <script src="https://cdn.jsdelivr.net/instantsearch.js/2.10.1/instantsearch.min.js"></script>
   <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesAutocompleteDataset.min.js"></script>
</body>
</html>
