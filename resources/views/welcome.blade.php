<!-- welcome page -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Deutsch Test - Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600| Source+Serif+Pro:700" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body{
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 90vh;
            margin: 0;
        }
        footer{
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin-bottom: 5px;
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
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .title > a {
            color: black;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links > a{
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <!-- title / logo -->
        <div class="title">
            <a href="{{ url('test/') }}">{{ config('APP_NAME', 'Deutsch Test') }}</a>
        </div>

        <!-- main idea -->
        <div id="slogan" style="letter-spacing: 8px; margin-top:-8px; margin-bottom:150px;">
            Learing Deutsch and building a better future.
        </div>

        <!-- guide links -->
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/test') }}">Tests</a>
                    | <a href="{{ url('home') }}">Evaluation</a>
                    | <a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        | <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

</div>
<div>
    <!-- Footer -->
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
