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
    <!-- Styles -->
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
                <h2 class="col-md-10 text-left mouse-pointer oper-title">ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ กรมที่ดิน</h2>
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
                      <a class="navbar-brand dol-nav-logo" href="{{url('/')}}">Computer Operation Section</a>
                    </div>

                     <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li class="@if(!empty($menu_home)) active @endif"><a href="{{url('/home')}}"><i class="fa fa-home"></i> หน้าหลัก <span class="sr-only">(current)</span></a></li>
                        <li><a href="#"><i class="fa fa-share-alt"></i> ข่าวประชาสัมพันธ์ </a></li>
                        <li><a href="#"><i class="fa fa-users"></i> บุคลากร </a></li>
                        <li><a href="{{url('/contactUs')}}"><i class="fa fa-map-marker"></i> ติดต่อเรา </a></li>
                      </ul>
                        
                      <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            @if(Auth::user()->level >= SUPERUSER)
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-reorder"></i> <span class="text-for-mobile">บริการของเรา </span></a>
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
                                        <a href="{{url('/linkHome')}}" class="dol-nav-submenu">
                                            <i class="fa fa-tasks dol-ico-menu"></i></br>
                                            สถานะเครือข่าย
                                        </a>
                                    </li>
                                    <li class="list-unstyled col-md-3 text-center">
                                        <a href="http://172.29.3.23/Linkmonitor/chk_link.php" target="_blank" class="dol-nav-submenu">
                                            <i class="fa fa-calendar-check-o dol-ico-menu"></i></br>
                                            Check List
                                        </a>
                                    </li>
                                    <li class="list-unstyled col-md-3 text-center">
                                        <a href="{{url('/calTime')}}" class="dol-nav-submenu">
                                            <i class="fa fa-clock-o dol-ico-menu"></i></br>
                                            โปรแกรมคำนวณเวลา
                                        </a>
                                    </li>
                                    <li class="list-unstyled col-md-3 text-center">
                                        <a href="http://www2.dol.truegse.com" target="_blank" class="dol-nav-submenu">
                                            <i class="fa fa-unlink dol-ico-menu"></i></br>
                                            แจ้ง Link True
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        @endif
                        @if(!Auth::check())
                            <li><a href="{{url('/register')}}">ลงทะเบียน</a></li>
                            <li><a href="{{url('/login')}}">เข้าสู่ระบบ</a></li>
                        @else
                            <li class="dropdown dol-dropdown-user">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i @if(Auth::user()->level == WEBMASTER) class="fa fa-user-secret" @else class="fa fa-user-circle" @endif></i> <span class="text-for-mobile">{{Auth::user()->firstname}}</span></a>
                              <ul class="dropdown-menu dol-dropdown-user-menu">
                                <li><a href="#"><i class="fa fa-lock"></i><span>เปลี่ยนรหัสผ่าน</span></a></li>
                                <li><a href="{{url('/requestEmailChange')}}"><i class="fa fa-envelope"></i><span>เปลี่ยนอีเมล</span></a></li>
                                <li><a href="{{url('/user/self/profile')}}"><i class="fa fa-address-book"></i><span>โปรไฟล์</span></a></li>
                                <li role="separator" class="divider"></li>
                                @if(!empty(Auth::user()->newCityAdmin))
                                    <li class="hideIfPC"><a href="{{url('/linkCity/activeMobileView')}}/{{Auth::user()->newCityAdmin->city->city_id}}"><i class="fa fa-tasks"></i><span>สถานะเครือข่าย</span></a></li>
                                    <li class="hideIfMobile"><a href="{{url('/linkCity')}}/{{Auth::user()->newCityAdmin->city->city_id}}"><i class="fa fa-tasks"></i><span>สถานะเครือข่าย</span></a></li>
                                    <li role="separator" class="divider"></li>
                                @endif
                                @if(Auth::user()->level == WEBMASTER)
                                    <!-- Webmaster's Menu -->
                                    <li><a href="{{url('/usermanagement/index')}}"><i class="fa fa-users"></i><span>จัดการผู้ใช้งาน</span></a></li>
                                    <li><a href="{{url('/webmaster/logs')}}" target="_blank"><i class="fa fa-server"></i><span>Logs</span></a></li>
                                    <li role="separator" class="divider"></li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i><span>ออกจากระบบ
                                    </span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                              </ul>
                            </li>
                            @if(isset($searchEngine->enable))
                                <form type="searchEngine" class="navbar-form navbar-right" action="{{$searchEngine->link}}" method="GET" style="margin-right: 0px;">
                                    <div class="input-group">
                                        <input name="{{$searchEngine->inputName}}" type="text" class="form-control dol-search-input" placeholder="{{$searchEngine->placeHolder}}">
                                        <span onclick="$('form[type=searchEngine]').submit();" class="input-group-addon dol-search1" id="basic-addon1" style="cursor: pointer;"><i class="fa fa-search"></i></span>
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
        <div id="pageLoading" class="pageLoading text-center">
            <h4><i class="fa fa-spinner fa-spin"></i> กรุณารอสักครู่</h4>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 widget">
                    <h2><i class="fa fa-area-chart"></i> สถิติการใช้งานเว็บไซต์</h2>
                    <article class="widget_content">
                        <ul>
                            <li>เข้าชมทั้งหมด <span class="pull-right"> {{ Counter::allHits() }}</span></li>
                            <li>7 วันล่าสุด <span class="pull-right"> {{ Counter::allHits(7) }}</span></li>
                            <li>เดือนนี้ <span class="pull-right"> {{ App\selfCounter::where('created_at','LIKE','%' .date('Y').'-'. date('m') . '-%')->count() }}</span></li>
                            <li>ปีนี้ <span class="pull-right"> {{ App\selfCounter::where('created_at','LIKE', date('Y') . '-%')->count() }}</span></li>
                     </ul>
                     </article>
                </div>
                <div class="col-md-1 widget"></div>
                <div class="col-md-3 widget">
                    <h2><i class="fa fa-share-alt"></i> เว็บไซต์แนะนำ</h2>
                    <article class="widget_content">
                        <ul>
                            <li><a target="_blank" href="http://www.dol.go.th" class="no-decoration">กรมที่ดิน</a></li>
                            <li><a target="_blank" href="#" class="no-decoration">สำนักเทคโนโลยีสารสนเทศ</a></li>
                            <li><a target="_blank" href="http://nam.dol.go.th/personnel/Pages/default.aspx" class="no-decoration">กองการเจ้าหน้าที่</a></li>
                            <li><a target="_blank" href="http://www.dol.go.th/dol/index.php?option=com_payroll" class="no-decoration">สืบค้นการจ่ายเงินเดือน</a></li>
                     </ul>
                    </article>
                </div>
                <div class="col-md-4 widget">
                    <h2><i class="fa fa-map-marker"></i> ติดต่อเรา</h2>
                    <article class="widget_content">
                        <p>ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ<br>ชั้น 4 อาคารรังวัดและทำแผนที่ กรมที่ดิน <br>ตำบลบางพูด อำเภอปากเกร็ด จังหวัดนนทบุรี 11120<br><i class="fa fa-phone-square"></i> 0 2503 3369 (08.30 น. - 16.30 น.)</p>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 widget"><i class="fa fa-copyright"></i> 2018 | {{ config('app.name')}} 
                    <span class="pull-right hideIfMobile">Support  
                        <i class="fa fa-chrome"></i>
                        <i class="fa fa-firefox"></i>
                        <i class="fa fa-internet-explorer"></i>
                        <i class="fa fa-opera"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Footer -->
    <!-- Scripts -->
    <script src="{{ url('/resources/assets/bootstrap/js/jquery-1.10.1.min.js') }}"></script>
    <script src="{{ url('/public/js/app.js')}}"></script>
    <script src="{{ url('/public/js/footer.js')}}"></script>
    <!--<script src="{{ url('/resources/assets/bootstrap/js/bootstrap.min.js') }}"></script>-->
    @yield('script')
</body>
</html>
