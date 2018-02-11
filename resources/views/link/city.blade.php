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
            <h5>ระหว่างศูนย์สารสนเทศที่ดิน กับสำนักงานที่ดิน@if($city->city_id != 1)จังหวัด@endif{{$city->city_name}}</h5>
            @if(Auth::user()->level == WEBMASTER)
                <form class="form-inline" role="form" method="POST" action="{{url('/newCityAdmin/store')}}" style="margin-bottom: 65px;">
                    {{ csrf_field() }}
                    <input type="hidden" name="ref" value="{{$city->city_id}}">
                    <div class="col-md-12">
                        <div class="input-group">
                            <select class="form-control" name="ref2">
                                <option value="">ตำแหน่งว่าง</option>
                                @foreach(App\User::where('level', '<=', 6)->get() as $user)
                                    <option value="{{$user->id}}" @if(!empty($city->newCityAdmin)) @if($user->id == $city->newCityAdmin->user_id) selected @endif @endif>{{$user->email}} - {{$user->firstname}}  {{$user->lastname}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default" onclick="getPageLoading();">
                                    <i class="fa fa-save"></i>
                                    บันทึก
                                </button>
                            </span>
                        </div>                        
                    </div>
                </form>
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="fa fa-check"> บันทึกข้อมูลสำเร็จ</span>
                    </div>
                @endif
            @endif
            <h5>ADMIN : @if(isset($city->newCityAdmin->user->id)) {{$city->newCityAdmin->user->prefix}} {{$city->newCityAdmin->user->firstname}}&nbsp&nbsp{{$city->newCityAdmin->user->lastname}} @else ว่าง @endif</h5>
            @if(isset($city->newCityAdmin->user->id))
                <h5>โทรศัพท์ : @if($city->newCityAdmin->user->phone != '-') {{$city->newCityAdmin->user->phone}} @if($city->newCityAdmin->user->phone2 != '-') , {{$city->newCityAdmin->user->phone2}} @endif @endif</h5> 
            @endif
        </div>
        <div class="col-md-3 text-right">
            <h5 class="text-info" style="margin-top: 20px;">{{App\CalTime::getTimeNow()}}</h5>
            <p class="text-info">เวลา <span id="clock">{{date('H:i:s')}}</span> น.</p>
            @if(Auth::user()->level >= SUPERUSER)
                <a href="{{url('/linkHome')}}" style="text-decoration: none;"><i class="fa fa-arrow-circle-o-left"></i> ย้อนกลับ</a>
            @else
                <a href="{{url('/home')}}" style="text-decoration: none;"><i class="fa fa-home"></i> หน้าหลัก</a>
            @endif
        </div>
        <div class="col-md-12" style="padding: 0px;">
            <table class="table table-hover">
                <tr class="text-center bg-info">
                    <td class="col-md-3"><strong>จังหวัด/สาขา/ส่วนแยก/อำเภอ</strong></td>
                    <td class="col-md-1"><strong>Gateway</strong></td>
                    <td class="col-md-1"><strong>WAN1</strong></td>
                    <td class="col-md-1"><strong>WAN2</strong></td>
                    <td class="col-md-3" colspan="2"><strong>เบอร์โทรสำนักงาน</strong></td>
                    <td class="col-md-1"><strong></strong></td>
                </tr>
                @forelse($city->linkData as $i => $linkData)
                    @if(strpos($linkData->city_name1, 'อำเภอ') === FALSE)
                    <tr>
                        <td>{{$linkData->city_name1}}</td>
                        <td class="text-center">@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'GateWay'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @endif</td>
                        <td class="text-center">@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan1'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @endif</td>
                        <td class="text-center">@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan2'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan2_1}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan2_1}}</div></div> @endif</td>
                        <td class="text-center" colspan="2">
                            @if($linkData->author->count() > 0)
                                <a data-toggle="collapse" href="#collapse{{$i+1}}" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}" class="btn-block no-decoration"><i class="fa fa-phone"></i> หมายเลขโทรศัพท์</a>
                                <div id="collapse{{$i+1}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="padding: 0% 10% 0% 10%;">
                                    @foreach($linkData->author as $author)
                                        <a href="tel:{{$author->number}}" class="label-blank btn-block">@if($author->type == 1) <i class="fa fa-tty"></i> @elseif($author->type == 2) <i class="fa fa-fax"></i> @elseif($author->type == 3) <i class="fa fa-user-circle"></i> @elseif($author->type == 4) <i class="fa fa-microphone"></i> @elseif($author->type == 5) <i class="fa fa-file-video-o"></i> @endif {{$author->name}} 
                                        <span class="btn-under">{{$author->number}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <a class="text-muted no-decoration">ยังไม่ระบุหมายเลขโทรศัพท์</a>
                            @endif
                        </td>
                        <td>
                            <!-- Button Right -->
                            @if($linkData->author->count() > 0)
                                <a class="label-online" href="{{url('/linkdata/author')}}/{{$linkData->id}}">
                                    <i class="fa fa-cogs" style="padding: 3px 5px 3px 5px;"></i>
                                            ตั้งค่า
                                </a>
                            @else
                                <a class="label-online" href="{{url('/linkdata/author')}}/{{$linkData->id}}">
                                    <i class="fa fa-plus" style="padding: 3px 5px 3px 5px;"></i>
                                            เพิ่ม
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endif
                @empty
                    <tr class="text-center bg-danger">
                        <td colspan="7">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse    
                @forelse($city->linkData->sortBy('city_name') as $i => $linkData)
                    @if(strpos($linkData->city_name1, 'อำเภอ'))
                    <tr>
                        <td>{{$linkData->city_name1}}</td>
                        <td class="text-center">@if(App\LinkDownAMP::where([['n_city2','=', $linkData->city_name1],['job_down','=','OFF'],['link_status', '=', 'GateWay'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_gw}}</div></div> @endif</td>
                        <td class="text-center">@if(App\LinkDownAMP::where([['n_city2','=', $linkData->city_name1],['job_down','=','OFF'],['link_status', '=', 'Wan1'],])->count()) <div class="popup-main"><span class="label-offline"><i class="fa fa-close"></i> Down</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @else <div class="popup-main"><span class="label-online"><i class="fa fa-check"></i> Online</span><div class="popup-item" style="margin-bottom: 7px;">{{$linkData->ip_wan1_1}}</div></div> @endif </td>
                        <td></td>
                        <td class="text-center" colspan="2">
                            @if($linkData->author->count() > 0)
                                <a data-toggle="collapse" href="#collapse{{$i+1}}" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}" class="btn-block no-decoration"><i class="fa fa-phone"></i> หมายเลขโทรศัพท์</a>
                                <div id="collapse{{$i+1}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="padding: 0% 10% 0% 10%;">
                                    @foreach($linkData->author as $author)
                                        <a href="tel:{{$author->number}}" class="label-blank btn-block">@if($author->type == 1) <i class="fa fa-tty"></i> @elseif($author->type == 2) <i class="fa fa-fax"></i> @elseif($author->type == 3) <i class="fa fa-user-circle"></i> @elseif($author->type == 4) <i class="fa fa-microphone"></i> @elseif($author->type == 5) <i class="fa fa-file-video-o"></i> @endif {{$author->name}} 
                                        <span class="btn-under">{{$author->number}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <a class="text-muted no-decoration">ยังไม่ระบุหมายเลขโทรศัพท์</a>
                            @endif
                        </td>
                        <td>
                            <!-- Button Right -->
                            @if($linkData->author->count() > 0)
                                <a class="label-online" href="{{url('/linkdata/author')}}/{{$linkData->id}}">
                                    <i class="fa fa-cogs" style="padding: 3px 5px 3px 5px;"></i>
                                            ตั้งค่า
                                </a>
                            @else
                                <a class="label-online" href="{{url('/linkdata/author')}}/{{$linkData->id}}">
                                    <i class="fa fa-plus" style="padding: 3px 5px 3px 5px;"></i>
                                            เพิ่ม
                                </a>
                            @endif
                        </td>
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
            getPageLoading();
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
        function getPageLoading(){
            $('#pageLoading').css('display','block');
        }
    </script>
@endsection