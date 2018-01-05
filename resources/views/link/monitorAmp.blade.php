@extends('layouts.app_no_bar')
@section('meta')
    <meta http-equiv="refresh" content="300"/>
@endsection
@section('content')
<div class="container">
    <div class="col-md-12 space-30"></div>
    <div class="row">
        <div class="col-md-3 no-padding">
            <img class="space-20" style="width: 50%;" src="{{url('/resources/images/public/oper.png')}}">
        </div>
        <div class="col-md-6 text-center">
            <h3 class="text-primary">สถานะการเชื่อมโยงระบบเครือข่ายสื่อสาร กรมที่ดิน</h3>
            <h5>ระหว่างศูนย์สารสนเทศที่ดิน กับสำนักงานที่ดินอำเภอ</h5>
            <h5 class="text-danger">@if(!empty($search)) (จากผลการค้นหา "{{$search}}") @endif</h5>
            <h2 class="text-danger" style="margin-top: 0px;padding-bottom: 20px;">Total Link Down :  @if($pageNumber) {{$linkDown->count()+($linkDown->total()-2*$linkDown->perpage())+$linkDown->lastItem()}} @else {{$linkDown->count()}} @endif Link </h2>
        </div>
        <div class="col-md-3 text-right">
            <h5 class="text-info" style="margin-top: 20px;">{{App\CalTime::getTimeNow()}}</h5>
            <p class="text-info">เวลา <span id="clock">{{date('H:i:s')}}</span> น.</p>
            <a href="{{url('/home')}}"><i class="fa fa-home"></i> หน้าหลัก</a>
        </div>
        <div class="col-md-12" style="padding: 0px;">
            <table class="table table-hover">
                <tr class="text-center bg-info">
                    <td class="col-md-2"><strong>เครื่อข่าย</strong></td>
                    <td class="col-md-1"><strong>จังหวัด</strong></td>
                    <td class="col-md-3"><strong>สาขา/ส่วนแยก/อำเภอ</strong></td>    
                    <td class="col-md-1"><strong>วัน</strong></td>
                    <td class="col-md-1"><strong>เวลา</strong></td>
                    <td class="col-md-2"><strong>รวมเวลา</strong></td>
                    <td class="col-md-2"><strong>ผู้ดูแล</strong></td>
                </tr> 
                @foreach($linkDown as $i => $link)
                    <tr class="text-center">
                        <!-- <td><img src="{{url('/resources/images/public/alarm.gif')}}" style="{{App\CalTime::widthImage($link->time_down, $link->date_down)}}"></td> -->
                        <td class="text-left" style="padding-left: 3%;">
                            <div class="popup-main">
                                @if($link->link_status == 'GateWay')
                                    <div class="label-offline text-uppercase">
                                        <i class="fa fa-dot-circle-o animate-ico" downAlert="1"></i>
                                        {{$link->link_status}}
                                    </div>
                                @else
                                    <div class="label-blank text-uppercase">
                                        <i class="fa fa-exclamation"></i>
                                        {{$link->link_status}}
                                    </div>
                                @endif
                                <span class="popup-item" style="margin-bottom: 7px;">
                                    @if($link->link_status == 'GateWay')
                                        Gateway : {{$link->linkData->ip_gw}}
                                    @elseif($link->link_status == 'Wan1')
                                        WAN1 : {{$link->linkData->ip_wan1_1}}
                                    @else
                                        WAN2 : {{$link->linkData->ip_wan2_1}}
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td><a href="{{url('/linkCity')}}/{{$link->linkData->city->city_id}}">{{$link->n_city1}}</a></td>
                        <td>
                            <div class="popup-main">{{$link->n_city2}}
                                <span class="popup-item">
                                    WAN1 : {{$link->linkData->ip_wan1_1}}</br>
                                    WAN2 : {{$link->linkData->ip_wan2_1}}</br>
                                    Gateway : {{$link->linkData->ip_gw}}&nbsp
                                </span>
                            </div>
                        </td>
                        <td>{{$link->date_down}}</td>
                        <td>{{$link->time_down}}</td>
                        <td>{{App\CalTime::timeDown($link->time_down, $link->date_down)}}</td>
                        <td>{{$link->job_user}}</td>
                    </tr> 
                @endforeach
            </table>
            <div class="col-md-12" style="padding: 0px;">
                <div class="col-md-6 no-padding" style="margin-top: 20px;">
                    <form id="formPerPage" class="form-horizontal" role="form" method="GET" action="{{url('/linkmonitorAmp')}}">
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="ค้นหา..." value="{{$search}}">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="margin-left: 0px;">
                            <div class="input-group">
                                <span class="input-group-addon">แสดงผล</span>
                                <select name="list" class="form-control">
                                    <option value="25" @if($perPage == 25) selected @endif>25</option>
                                    <option value="50" @if($perPage == 50) selected @endif>50</option>
                                    <option value="75" @if($perPage == 75) selected @endif>75</option>
                                    <option value="100" @if($perPage == 100) selected @endif>100</option>
                                    <option value="all" @if($perPage == 'all') selected @endif>ทั้งหมด</option>
                                </select>
                                <span class="input-group-addon">แถว</span>
                            </div>
                        </div>                        
                    </form>
                </div>
                @if($pageNumber) <div class="col-md-6 text-right" style="padding-right: 0px;">{{$linkDown->links()}}</div> @endif       
            </div>
        </div>
    </div>
    <audio id="sound1">
        <source src="{{url('/resources/sound/beep-09.mp3')}}">
    </audio>
</div>
<!-- Spell -->
@endsection
@section('script')
<script src="{{ url('/resources/assets/js/dol-theme.js')}}"></script>
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
    <script type="text/javascript">    
        $('select[name=list]').change(function(){
            $('#formPerPage').submit();
        });
        setInterval(function(){ 
            var clockNow = $('#clock').text(); clockNow = clockNow.split(':');
            var hour = parseInt(clockNow[0]);
            var min = parseInt(clockNow[1]);
            var sec = parseInt(clockNow[2])+1;
            if(sec == 60){sec = 0;min++;}
            if(min == 60){min = 0;hour++;}
            if(hour == 24){hour = 0;}
            if(sec < 10) sec = '0'+sec;
            if(min < 10) min = '0'+min;
            if(hour < 10) hour = '0'+hour;
            $('#clock').text(hour+':'+min+':'+sec);
        }, 1000);
   </script>
@endsection