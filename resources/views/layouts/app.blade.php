<!-- banner for user mode-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('APP_NAME', 'Deutsch Test') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .navbar-brand{
            margin-left: 30px;
            font-size: 25px;
            font-weight: 500;
            color: #23000a;
        }

        .navbar-brand:hover{
            color: #23000a;
        }

        #bannerDiv{
            height:60px;
            width:100%;
            background-color: white;
            display: flex;
            box-shadow: 0px 2px 2px #d6d6d6;
            position: fixed;
            top:0px;
        }

        #bannerLinks{
            margin-top:20px;
            width: 1030px;
        }

        .bannerLink{
            text-decoration: none;
            color: grey;
            margin-left: 30px;
            text-align:center;
        }

        .logLink{
            text-decoration: none;
            color: grey;
            text-align:center;
        }

        .logLink:hover{
            color:black;
            text-decoration: none;
        }
        .bannerLink:hover{
            color:black;
            text-decoration: none;
        }

    </style>

</head>
<body>
    <div id="app">
        <div id="bannerDiv">
            <!-- title -->
            <div>
                <a style="margin-top:5px" class="navbar-brand" href="{{ url('/') }}">
                    {{ config('APP_NAME', 'Deutsch Test') }}
                </a>
            </div>

            <!-- guide links -->
            <div id="bannerLinks">
                <a class="bannerLink" href="{{ url('/test') }}">Tests</a>
                <a class="bannerLink" href="{{ url('/home') }}">Evaluation</a>
            </div>


            <!-- logout / Login & Register-->
            <div style="margin-top:20px;">
                @auth
                <a class="logLink" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                @else
                    <a class="logLink" href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        | <a class="logLink" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        </div>

        <main class="py-4" style="margin-top:38px;">
            @yield('content')
        </main>
    </div>

    <div>

        <br/><br/><br/><br/>
        <!-- Footer /  copyright declaration-->
        <footer class="footer">
            <div style="text-align:center;font-size:12px;">
                <p>
                    <strong>© 2019 Copyright: Fangwen Liao | Xinyue Shi | Yun Hua </strong>
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
