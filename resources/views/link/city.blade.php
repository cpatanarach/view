@extends('layouts.app_no_bar')
@section('meta')
    <meta http-equiv="refresh" content="30"/>
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
            <h5>ระหว่างศูนย์สารสนเทศที่ดิน กับสำนักงานที่ดินจังหวัด{{$city->city_name}}</h5>
            <h5>ADMIN : @if(isset($city->newCityAdmin->user->id)) {{$city->newCityAdmin->user->firstname}} {{$city->newCityAdmin->user->lastname}} @else ว่าง @endif</h5>
            <h5>โทรศัพท์ : @if(isset($city->newCityAdmin->user->phone)) {{$city->newCityAdmin->user->phone}} @if(isset($city->newCityAdmin->user->phone2)) , {{$city->newCityAdmin->user->phone2}} @endif @endif</h5>

        </div>
        <div class="col-md-3 text-right">
            <h5 class="text-info" style="margin-top: 20px;">{{App\CalTime::getTimeNow()}}</h5>
            <p class="text-info">เวลา <span id="clock">{{date('H:i:s')}}</span> น.</p>
            <a href="{{url('/linkHome')}}" style="text-decoration: none;"><i class="fa fa-arrow-circle-o-left"></i> ย้อนกลับ</a>
        </div>
        <div class="col-md-12" style="padding: 0px;">
            <table class="table table-hover">
                <tr class="text-center bg-info">
                    <td class="col-md-3"><strong>จังหวัด/สาขา/ส่วนแยก/อำเภอ</strong></td>
                    <td class="col-md-1"><strong>Gateway</strong></td>
                    <td class="col-md-1"><strong>WAN1</strong></td>
                    <td class="col-md-1"><strong>WAN2</strong></td>
                    <td class="col-md-2"><strong>เบอร์โทรสำนักงาน</strong></td>
                    <td class="col-md-2"><strong>ผู้ดูแล</strong></td>
                    <td class="col-md-2"><strong>เบอร์โทรผู้ดูแล</strong></td>
                </tr>
                @forelse($city->linkData as $linkData)
                    @if(strpos($linkData->city_name1, 'อำเภอ') === FALSE)
                    <tr>
                        <td>{{$linkData->city_name1}}</td>
                        <td class="text-center">@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'GateWay'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @endif</td>
                        <td class="text-center">@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan1'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @endif</td>
                        <td class="text-center">@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan2'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan2_1}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan2_1}}</div></div> @endif</td>
                        <td class="text-left">
                                @if(!empty($linkData->cityTel->tel1))
                                    <div class="popup-main">
                                        <a class="label-blank" href="{{url('/editInformation')}}/{{$city->city_id}}">
                                            <i class="fa fa-phone"></i>
                                            {{$linkData->cityTel->tel1}}
                                        </a>
                                        @if(!empty($linkData->cityTel->tel2) || !empty($linkData->cityTel->tel3) || !empty($linkData->cityTel->tel4) || !empty($linkData->cityTel->tel5))
                                            <div class="popup-item" style="margin-bottom: 7px;">
                                                @if(!empty($linkData->cityTel->tel2)) <p>{{$linkData->cityTel->tel2}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel3)) <p>{{$linkData->cityTel->tel3}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel4)) <p>{{$linkData->cityTel->tel4}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel5)) <p>{{$linkData->cityTel->tel5}}</p> @endif
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="popup-main">
                                        <a class="label-online" href="{{url('/editInformation')}}/{{$city->city_id}}">
                                            <i class="fa fa-plus" style="padding: 3px 5px 3px 5px;"></i>
                                            เพิ่มหมายเลข
                                        </a>
                                        @if(!empty($linkData->cityTel->tel2) || !empty($linkData->cityTel->tel3) || !empty($linkData->cityTel->tel4) || !empty($linkData->cityTel->tel5))
                                            <div class="popup-item" style="margin-bottom: 7px;">
                                                @if(!empty($linkData->cityTel->tel2)) <p>{{$linkData->cityTel->tel2}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel3)) <p>{{$linkData->cityTel->tel3}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel4)) <p>{{$linkData->cityTel->tel4}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel5)) <p>{{$linkData->cityTel->tel5}}</p> @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif
                        <td></td>
                        <td></td>
                    </tr>
                    @endif
                @empty
                    <tr class="text-center bg-danger">
                        <td colspan="7">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse    
                @forelse($city->linkData->sortBy('city_name') as $linkData)
                    @if(strpos($linkData->city_name1, 'อำเภอ'))
                    <tr>
                        <td>{{$linkData->city_name1}}</td>
                        <td class="text-center">@if(App\LinkDownAMP::where([['n_city2','=', $linkData->city_name1],['job_down','=','OFF'],['link_status', '=', 'GateWay'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @endif</td>
                        <td class="text-center">@if(App\LinkDownAMP::where([['n_city2','=', $linkData->city_name1],['job_down','=','OFF'],['link_status', '=', 'Wan1'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @endif </td>
                        <td></td>
                        <td class="text-left">
                                @if(!empty($linkData->cityTel->tel1))
                                    <div class="popup-main">
                                        <a class="label-blank" href="{{url('/editInformation')}}/{{$city->city_id}}">
                                            <i class="fa fa-phone"></i>
                                            {{$linkData->cityTel->tel1}}
                                        </a>
                                        @if(!empty($linkData->cityTel->tel2) || !empty($linkData->cityTel->tel3) || !empty($linkData->cityTel->tel4) || !empty($linkData->cityTel->tel5))
                                            <div class="popup-item" style="margin-bottom: 7px;">
                                                @if(!empty($linkData->cityTel->tel2)) <p>{{$linkData->cityTel->tel2}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel3)) <p>{{$linkData->cityTel->tel3}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel4)) <p>{{$linkData->cityTel->tel4}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel5)) <p>{{$linkData->cityTel->tel5}}</p> @endif
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="popup-main">
                                        <a class="label-online" href="{{url('/editInformation')}}/{{$city->city_id}}">
                                            <i class="fa fa-plus" style="padding: 3px 5px 3px 5px;"></i>
                                            เพิ่มหมายเลข
                                        </a>
                                        @if(!empty($linkData->cityTel->tel2) || !empty($linkData->cityTel->tel3) || !empty($linkData->cityTel->tel4) || !empty($linkData->cityTel->tel5))
                                            <div class="popup-item" style="margin-bottom: 7px;">
                                                @if(!empty($linkData->cityTel->tel2)) <p>{{$linkData->cityTel->tel2}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel3)) <p>{{$linkData->cityTel->tel3}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel4)) <p>{{$linkData->cityTel->tel4}}</p> @endif
                                                @if(!empty($linkData->cityTel->tel5)) <p>{{$linkData->cityTel->tel5}}</p> @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif
                @empty
                    <tr class="text-center bg-danger">
                        <td colspan="7">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse            
            </table>
        </div>
    </div>
    <input type="hidden" name="activeMobileView" value="{{$activeMobileView}}">
</div>
@endsection
@section('script')
    <script src="{{url('/resources/assets/js/main_mobile.js')}}"></script>
    <script type="text/javascript">
        if(isMobile()){
            window.location = $('input[name=activeMobileView]').val();
        }
        setTimeout(function() {
            location.reload();
        }, 300000);
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