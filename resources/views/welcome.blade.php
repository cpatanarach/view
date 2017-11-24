<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
         <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" type="text/css">
        <link href="{{ url('/resources/assets/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', 'Kanit', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > .basic-link{
                font-size: 15px; font-weight: 200;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .links > .danger-text{
                color: #f00;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a class="basic-link" href="{{ url('/profile') }}">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
                        <a class="basic-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> 
                                     ออกจากระบบ
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                    @else
                        <a class="basic-link" href="{{ url('/login') }}">Login</a>
                        <a class="basic-link" href="{{ url('/register') }}">Register</a>

                    @endif
                    
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                   <img src="{{url('/resources/images/public/oper.png')}}">
                </div>

                <div class="links">
                    <a href="{{url('/linkHome')}}">Linkmonitor</a>
                    <a href="https://www.facebook.com/profile.php?id=100006365016708&fref=ts">Our Facebook</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        {!!csrf_field()!!}
    </body>
</html>
