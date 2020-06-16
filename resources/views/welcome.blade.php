<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BoolBnB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('upr.homes.index') }}">Dashboard</a>
                        <a href="{{ route('guest.homes.index') }}">Home</a>
                    @else
                        <a href="{{ route('guest.homes.index') }}">Home</a>
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth

                </div>
            @endif

            <div class="content">
                <div class="title m-b-md created">
                    Progetto BoolBnB
                </div>
                <div class="title m-b-md">
                    <h6 class="created">Created By</h6>
                </div>
                <div class="links">
                    <a class="link-user" target="_blank" href="https://github.com/Chri-B"><i class="fab fa-github"></i> Beretta Christian</a>
                    <a class="link-user" target="_blank" href="https://github.com/Mirko2552150"><i class="fab fa-github"></i> Longo Mirko</a>
                    <a class="link-user" target="_blank" href="https://github.com/FilippoMailli"><i class="fab fa-github"></i> Mailli Filippo</a>
                    <a class="link-user" target="_blank" href="https://github.com/Filippo79"><i class="fab fa-github"></i> Pittau Filippo</a>
                    <style>
                      .link-user:hover  {
                        color: red;
                      }
                      *  {
                        color: red;
                        font-family: courier;
                        font-size: 160%;
                      }
                      .created:hover {
                        transform: rotateY(360deg);
                        transition-duration: 5s;
                      }
                    </style>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- <script src="{{asset('app.js')}}" charset="utf-8"></script> --}}
    </body>
</html>
