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
    <link href="https://fonts.googleapis.com/css?family=Bad+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">  
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
    <!-- End of Font -->
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
                <img class="col-md-2 dol-title-logo" src="{{url('/resources/images/public/oper.png')}}"> 
                <h2 class="col-md-10 text-left mouse-pointer">ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ กรมที่ดิน</h2>
                <p class="col-md-10 text-muted oper-sub-title mouse-pointer">www.dol.go.th</p>
            </div>            
            <!-- Test NAV -->
            <nav class="navbar navbar-default dol-nav-style">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand dol-nav-logo" href="{{url('/')}}">Computer Operation Department</a>
                    </div>

                     <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li class="@if(!empty($menu_home)) active @endif"><a href="{{url('/linkHome')}}"><i class="fa fa-home"></i> หน้าหลัก <span class="sr-only">(current)</span></a></li>
                        <li><a href="#"><i class="fa fa-share-alt"></i> ข่าวประชาสัมพันธ์ </a></li>
                        @if(Auth::check())
                        @if(Auth::user()->level >= SUPERUSER)
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> โปรแกรมและลิงก์ </a>
                              <ul class="dropdown-menu row">
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="{{url('/linkmonitor')}}" target="_blank" class="dol-nav-submenu dol-menu-space">
                                        <i class="fa fa-tv dol-ico-menu"></i></br> 
                                        Link Monitor
                                    </a>
                                </li>
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="http://172.29.3.20" target="_blank" class="dol-nav-submenu dol-menu-space">
                                        <i class="fa fa-link dol-ico-menu"></i></br>
                                        What's up 20
                                    </a>
                                </li>
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="http://172.29.3.21" target="_blank" class="dol-nav-submenu dol-menu-space">
                                        <i class="fa fa-link dol-ico-menu"></i></br>What's up 21
                                    </a>
                                </li>
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="http://172.29.30.41/nagiosxi/includes/components/xicore/status.php?show=hosts" target="_blank" class="dol-nav-submenu dol-menu-space">
                                        <i class="fa fa-desktop dol-ico-menu"></i></br>
                                        Negios XI (TRUE)
                                    </a>
                                </li>

                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="{{url('/calTime')}}" class="dol-nav-submenu">
                                        <i class="fa fa-clock-o dol-ico-menu"></i></br>
                                        โปรแกรมคำนวณเวลา
                                    </a>
                                </li>
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="{{url('/linkHome')}}" class="dol-nav-submenu">
                                        <i class="fa fa-tasks dol-ico-menu"></i></br>
                                        City Status
                                    </a>
                                </li>
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="http://172.29.3.22/Linkmonitor/chk_link.php" target="_blank" class="dol-nav-submenu">
                                        <i class="fa fa-calendar-check-o dol-ico-menu"></i></br>
                                        Check List
                                    </a>
                                </li>
                                <li class="list-unstyled col-md-3 text-center">
                                    <a href="#" target="_blank" class="dol-nav-submenu">
                                        <i class="fa fa-phone-square dol-ico-menu"></i></br>
                                        เบอร์โทร ADMIN
                                    </a>
                                </li>
                              </ul>
                        </li>
                        @endif
                        @endif
                        <li><a href="#"><i class="fa fa-users"></i> บุคลากร </a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i> ติดต่อเรา </a></li>
                      </ul>
                        
                      <ul class="nav navbar-nav navbar-right">
                        @if(!Auth::check())
                            <li><a href="{{url('/register')}}">ลงทะเบียน</a></li>
                            <li><a href="{{url('/login')}}">เข้าสู่ระบบ</a></li>
                        @else
                            <li class="dropdown dol-dropdown-user">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> {{Auth::user()->firstname}}</a>
                              <ul class="dropdown-menu dol-dropdown-user-menu">
                                <li><a href="#">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="#">เปลี่ยนอีเมล</a></li>
                                <li><a href="#">เปลี่ยนรูปประจำตัว</a></li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> 
                                     ออกจากระบบ
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                              </ul>
                            </li>
                            @if(isset($searchEngine->enable))
                                <form class="navbar-form navbar-right" action="{{$searchEngine->link}}" method="GET" style="margin-right: 0px;">
                                    <div class="input-group">
                                        <input name="{{$searchEngine->inputName}}" type="text" class="form-control dol-search-input" placeholder="{{$searchEngine->placeHolder}}">
                                        <span class="input-group-addon dol-search1" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                </form>
                            @endif
                        @endif
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container fluid -->
            </nav>
            <!-- End Test NAV -->
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
