<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ กรมที่ดิน" />
    <meta name="keywords" content="oper dol, dol oper" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Oper') }}</title>
    <link rel="icon" href="{{url('/resources/images/public/oper.ico')}}"/>
    @yield('meta')
    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />
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
            <div class="container">
                <img class="col-md-2" style="padding: 20px 20px 10px 20px;" src="{{url('/resources/images/public/oper.png')}}"> 
                <h2 class="col-md-10 text-left mouse-pointer">ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ กรมที่ดิน</h2>
                <p class="col-md-10 text-muted oper-sub-title mouse-pointer">www.dol.go.th</p>
            </div>            
            <div id="nav-bar" class="container">
                <nav class="navbar navbar-default navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Start Menu -->
                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="navbar">
                            <li class="active"><a href="#">Active Link</a></li>
                            <li><a href="#">Link</a></li>
                          
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a> 
                              
                                <ul class="dropdown-menu">
                                  <li class="kopie"><a href="#">Dropdown</a></li>
                                    <li><a href="#">Dropdown Link 1</a></li>
                                    <li class="active"><a href="#">Dropdown Link 2</a></li>
                                    <li><a href="#">Dropdown Link 3</a></li>
                                  
                                    <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 4</a>
                                        <ul class="dropdown-menu">
                                            <li class="kopie"><a href="#">Dropdown Link 4</a></li>
                                            <li><a href="#">Dropdown Submenu Link 4.1</a></li>
                                            <li><a href="#">Dropdown Submenu Link 4.2</a></li>
                                            <li><a href="#">Dropdown Submenu Link 4.3</a></li>
                                            <li><a href="#">Dropdown Submenu Link 4.4</a></li>
                                                                              
                                        </ul>
                                    </li>
                                  
                                    <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 5</a>
                                        <ul class="dropdown-menu">
                                            <li class="kopie"><a href="#">Dropdown Link 5</a></li>
                                            <li><a href="#">Dropdown Submenu Link 5.1</a></li>
                                            <li><a href="#">Dropdown Submenu Link 5.2</a></li>
                                            <li><a href="#">Dropdown Submenu Link 5.3</a></li>
                                            
                                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
                                                <ul class="dropdown-menu">
                                                    <li class="kopie"><a href="#">Dropdown Submenu Link 5.4</a></li>
                                                    <li><a href="#">Dropdown Submenu Link 5.4.1</a></li>
                                                    <li><a href="#">Dropdown Submenu Link 5.4.2</a></li>
                                                    
                                                    
                                                </ul>
                                            </li>                           
                                        </ul>
                                    </li>                                   
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="kopie"><a href="#">Dropdown2</a></li>
                                    <li><a href="#">Dropdown2 Link 1</a></li>
                                    <li><a href="#">Dropdown2 Link 2</a></li>
                                    <li><a href="#">Dropdown2 Link 3</a></li>
                                    
                                    <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 Link 4</a>
                                        <ul class="dropdown-menu">
                                            <li class="kopie"><a href="#">Dropdown2 Link 4</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 4.1</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 4.2</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 4.3</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 4.4</a></li>
                                           
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 Link 5</a>
                                        <ul class="dropdown-menu">
                                            <li class="kopie"><a href="#">Dropdown Link 5</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 5.1</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 5.2</a></li>
                                            <li><a href="#">Dropdown2 Submenu Link 5.3</a></li>
                                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
                                                <ul class="dropdown-menu">
                                                    <li class="kopie"><a href="#">Dropdown2 Submenu Link 5.4</a></li>
                                                    <li><a href="#">Dropdown2 Submenu Link 5.4.1</a></li>
                                                    <li><a href="#">Dropdown2 Submenu Link 5.4.2</a></li>
                                                    
                                                </ul>
                                            </li>                                  
                                        </ul>
                                    </li>                                  
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--End Menu-->
                </nav>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ url('/resources/assets/bootstrap/js/jquery-1.10.1.min.js') }}"></script>
    <script src="{{ url('/public/js/app.js')}}"></script>
    <!--<script src="{{ url('/resources/assets/bootstrap/js/bootstrap.min.js') }}"></script>-->
    @yield('script')
</body>
</html>
