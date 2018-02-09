<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Oper') }}</title>
    <link rel="icon" href="{{url('/resources/images/public/oper.ico')}}"/>
    @yield('meta')
    <!-- Styles -->
    <!-- Bootstrap form web
    <link href="{{ url('/resources/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">    
    -->
    <link href="{{ url('/public/css/app.css') }}" rel="stylesheet">  
    <link href="{{ url('/resources/assets/bootstrap/css/dol-theme.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- font -->
    <style type="text/css">
        @font-face{
            font-family: "Kanit";
            font-weight: 400;
            src: url({{url('/resources/fonts/Kanit/Kanit-Regular.ttf')}}) format("truetype");
        }
        @font-face{
            font-family: "Bad script";
            font-weight: 400;
            src: url({{url('/resources/fonts/Bad_Script/BadScript-Regular.ttf')}}) format("truetype");
        }
        
        body{font-family: 'Kanit';font-weight: 300;}
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar-static-top oper-nav">            
        </nav>
        @yield('content')
        <div id="pageLoading" class="pageLoading text-center">
            <h4><i class="fa fa-spinner fa-spin"></i> กรุณารอสักครู่</h4>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ url('/resources/assets/bootstrap/js/jquery-1.10.1.min.js') }}"></script>
    <script src="{{ url('/public/js/app.js')}}"></script>
    <!--<script src="{{ url('/resources/assets/bootstrap/js/bootstrap.min.js') }}"></script>-->
    @yield('script')
</body>
</html>
