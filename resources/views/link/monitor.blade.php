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
            <h5>ระหว่างศูนย์สารสนเทศที่ดิน กับสำนักงานที่ดินจังหวัด/สาขา/ส่วนแยก</h5>
            <h5 class="text-danger">72 Link Down: {{$Link72_Count}} Link | 386 Link Down: {{$Link386_Count}} Link @if(!empty($search)) (จากผลการค้นหา "{{$search}}") @endif</h5>
            <h2 class="text-danger" style="margin-top: 0px;padding-bottom: 20px;">Total Link Down : {{$Link72_Count + $Link386_Count}} Link</h2>
        </div>
        <div class="col-md-3 text-right">
            <h5 class="text-info" style="margin-top: 20px;">{{App\CalTime::getTimeNow()}}</h5>
            <p class="text-info">เวลา <span id="clock">{{date('H:i:s')}}</span> น.</p>
            <a href="{{url('/home')}}" style="text-decoration: none;"><i class="fa fa-home"></i> หน้าหลัก</a>
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
                    @if($link->linkData->id < 73)
                    <tr class="text-center">
                        <!-- <td><img src="{{url('/resources/images/public/alarm.gif')}}" style="{{App\CalTime::widthImage($link->time_down, $link->date_down)}}"></td> -->
                        <td class="text-left" style="padding-left: 3%;">
                            <div class="popup-main">
                                @if($link->link_status == 'GateWay')
                                    <div class="label-offline text-uppercase" @if(App\Alert::isOwner($link->id)) dat="comment{{$link->id}}" onclick="showForm(this);" @else onclick="alert('หากมีความจำเป็นที่จะต้องดำเนินการแทน โปรดแจ้งให้เวรประจำห้องศุนย์ทราบและดำเนินการต่อไป');" @endif >
                                        <i class="fa fa-dot-circle-o animate-ico" @if(!App\Alert::hasComment($link->id)) downAlert="1" @endif > </i>
                                        {{$link->link_status}}
                                    </div>
                                @else
                                    <div class="label-blank text-uppercase" @if(App\Alert::isOwner($link->id)) dat="comment{{$link->id}}" onclick="showForm(this);" @else onclick="alert('หากมีความจำเป็นที่จะต้องดำเนินการแทน โปรดแจ้งให้เวรประจำห้องศุนย์ทราบและดำเนินการต่อไป');" @endif >
                                        <i class="fa fa-exclamation" @if(!App\Alert::hasComment($link->id)) downAlert="1" @endif ></i>
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
                            @if(App\Alert::isOwner($link->id))
                                @if(App\Alert::hasComment($link->id))
                                    <div class="popup-main">
                                        <div class="label-blank text-uppercase dol-no-border">
                                            <i class="fa fa-comments-o"></i>                                            
                                        </div>
                                        <span class="popup-item comment-reative">
                                            {{$link->alert->comment}}
                                        </span>
                                    </div>
                                @endif
                                <div class="popup-main">
                                    <div class="dol-alert-form" id="comment{{$link->id}}">
                                        <form class="form-horizontal" method="GET" role="form" action="{{url('/alert/wait')}}">
                                            <input type="hidden" name="ref" value="{{$link->id}}">
                                            <a class="text-left pull-right text-danger" href="#" onclick="closeForm(this);" dat="comment{{$link->id}}">Close <i class="fa fa-close"></i></a>
                                            <div style="width: 100%;padding: 10px;"></div>
                                            <div class="radio">
                                              <label class="col-md-4">
                                                <input type="radio" name="comment" id="blankRadio1" value="กำลังดำเนินการแก้ไข" aria-label="..." checked="checked" ind="{{$link->id}}"> กำลังดำเนินการแก้ไข
                                              </label>
                                              <label class="col-md-4">
                                                <input type="radio" name="comment" id="blankRadio2" value="ได้รับแจ้งว่าไฟฟ้าดับ" aria-label="..." ind="{{$link->id}}"> ได้รับแจ้งว่าไฟฟ้าดับ
                                              </label>
                                              <label class="col-md-4">
                                                <input type="radio" name="comment" id="blankRadio3" value="other" dat="{{$link->id}}" aria-label="..." onchange="onOtherChange(this)"> อื่นๆ...
                                              </label>
                                            </div>
                                            <textarea style="margin-top: 10px;" class="form-control comment-other" name="other" rows="3" id="other{{$link->id}}">
                                                
                                            </textarea>
                                            <button class="btn btn-success btn-sm btn-block" style="margin-top: 10px;" type="submit"><i class="fa fa-refresh"></i> UPDATE</button>
                                        </form>
                                    </div>
                                </div>

                            @else
                                @if(App\Alert::hasComment($link->id))
                                    <div class="popup-main">
                                        <div class="label-blank text-uppercase dol-no-border">
                                            <i class="fa fa-comments-o"></i>                                            
                                        </div>
                                        <span class="popup-item comment-reative"> 
                                            {{$link->alert->comment}}
                                        </span>
                                    </div>
                                @endif
                            @endif
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
                    @endif
                @endforeach  
                    <tr>
                        <td class="bg-danger text-center" colspan="8">End of 72 Site.</td>
                    </tr>
                @foreach($linkDown as $i => $link)
                    @if($link->linkData->id > 72)
                    <tr class="text-center">
                        <!--<td><img src="{{url('/resources/images/public/alarm.gif')}}" style="{{App\CalTime::widthImage($link->time_down, $link->date_down)}}"></td>
                        -->
                        <td class="text-left" style="padding-left: 3%;">
                            <div class="popup-main">
                                @if($link->link_status == 'GateWay')
                                    <div class="label-offline text-uppercase" @if(App\Alert::isOwner($link->id)) dat="comment{{$link->id}}" onclick="showForm(this);" @else onclick="alert('หากมีความจำเป็นที่จะต้องดำเนินการแทน โปรดแจ้งให้เวรประจำห้องศุนย์ทราบและดำเนินการต่อไป');" @endif >
                                        <i class="fa fa-dot-circle-o animate-ico" @if(!App\Alert::hasComment($link->id)) downAlert="1" @endif > </i>
                                        {{$link->link_status}}
                                    </div>
                                @else
                                    <div class="label-blank text-uppercase" @if(App\Alert::isOwner($link->id)) dat="comment{{$link->id}}" onclick="showForm(this);" @else onclick="alert('หากมีความจำเป็นที่จะต้องดำเนินการแทน โปรดแจ้งให้เวรประจำห้องศุนย์ทราบและดำเนินการต่อไป');" @endif >
                                        <i class="fa fa-exclamation" @if(!App\Alert::hasComment($link->id)) downAlert="1" @endif ></i>
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
                            @if(App\Alert::isOwner($link->id))
                                @if(App\Alert::hasComment($link->id))
                                    <div class="popup-main">
                                        <div class="label-blank text-uppercase dol-no-border">
                                            <i class="fa fa-comments-o"></i>                                            
                                        </div>
                                        <span class="popup-item comment-reative">
                                            {{$link->alert->comment}}
                                        </span>
                                    </div>
                                @endif
                                <div class="popup-main">
                                    <div class="dol-alert-form" id="comment{{$link->id}}">
                                        <form class="form-horizontal" method="GET" role="form" action="{{url('/alert/wait')}}">
                                            <input type="hidden" name="ref" value="{{$link->id}}">
                                            <a class="text-left pull-right text-danger" href="#" onclick="closeForm(this);" dat="comment{{$link->id}}">Close <i class="fa fa-close"></i></a>
                                            <div style="width: 100%;padding: 10px;"></div>
                                            <div class="radio">
                                              <label class="col-md-4">
                                                <input type="radio" name="comment" id="blankRadio1" value="กำลังดำเนินการแก้ไข" aria-label="..." checked="checked" ind="{{$link->id}}"> กำลังดำเนินการแก้ไข
                                              </label>
                                              <label class="col-md-4">
                                                <input type="radio" name="comment" id="blankRadio2" value="ได้รับแจ้งว่าไฟฟ้าดับ" aria-label="..." ind="{{$link->id}}"> ได้รับแจ้งว่าไฟฟ้าดับ
                                              </label>
                                              <label class="col-md-4">
                                                <input type="radio" name="comment" id="blankRadio3" value="other" dat="{{$link->id}}" aria-label="..." onchange="onOtherChange(this)"> อื่นๆ...
                                              </label>
                                            </div>
                                            <textarea style="margin-top: 10px;" class="form-control comment-other" name="other" rows="3" id="other{{$link->id}}">
                                                
                                            </textarea>
                                            <button class="btn btn-success btn-sm btn-block" style="margin-top: 10px;" type="submit"><i class="fa fa-refresh"></i> UPDATE</button>
                                        </form>
                                    </div>
                                </div>

                            @else
                                @if(App\Alert::hasComment($link->id))
                                    <div class="popup-main">
                                        <div class="label-blank text-uppercase dol-no-border">
                                            <i class="fa fa-comments-o"></i>                                            
                                        </div>
                                        <span class="popup-item comment-reative"> 
                                            {{$link->alert->comment}}
                                        </span>
                                    </div>
                                @endif
                            @endif
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
                    @endif
                @endforeach
            </table>
            <div class="col-md-12" style="padding: 0px;">
                <div class="col-md-6 no-padding" style="margin-top: 20px;">
                    <form id="formPerPage" class="form-horizontal" role="form" method="GET" action="{{url('/linkmonitor')}}">
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
                        <div class="dol-fix-bottom-right" id="config1">
                            <input name="speaker" type="checkbox" data-toggle="toggle" data-on="<i class='fa fa-volume-up'></i> Speaker&nbsp" data-off="<i class='fa fa-ban'></i> Muted&nbsp" data-style="ios" data-offstyle="default" @if($speaker == "on") checked @endif data-size="small">
                            <input name="soundtype" type="checkbox" data-toggle="toggle" data-on="<i class='fa fa-dot-circle-o'></i> Siren" data-off="<i class='fa fa-microphone'></i> Voice" data-style="ios" data-offstyle="success" @if($soundtype == "on") checked @endif data-size="small">  
                            <div style="display: inline-block;width: 42px;"></div>                                                     
                        </div>  
                        <div class="dol-fix-bottom-right" id="config2">
                            <div class="label-blank dol-no-border cog-style" style="display: inline-block;">
                                <i class="fa fa-cog" status="0" onclick="eventConfig(this);"></i>
                            </div>
                        </div>     
                    </form>
                </div>
                @if($pageNumber) <div class="col-md-6 text-right" style="padding-right: 0px;">{{$linkDown->links()}}</div> @endif       
            </div>
        </div>
    </div>
    <!-- Program Status --> 
    @if((int)$programStatus->format('%h') > 0 || (int)$programStatus->format('%i') > 10)
        <div class="dol-alert">      
            <h2 style="color: #fff;"><i class="fa fa-warning"></i> เกิดข้อผิดพลาด โปรดติดต่อผู้ดูแลระบบ</h2>
            <h4 style="color: #fff;">เซอร์วิสหยุดทำงาน : {{$programStatus->format('%a วัน %h ชั่วโมง %i นาที %s วินาที')}}</h4>
        </div>
    @endif
    <!-- Sound Beeb-->
    <div id="sound-track" style="display: none;" source="{{url('/resources/sound/beep-09.mp3')}}">
    </div>
</div>
<!-- Spell -->
<div id="spell" style="display: none;">
    <p>
    @foreach ($linkDown as $i => $link)
        @if(!App\Alert::hasComment($link->id))
            คุณ{{str_replace('/',' คุณ', $link->job_user)}} คะ .{{$link->n_city2}} {{$link->link_status}} Down  ค่ะ.
        @endif
    @endforeach
    </p>
</div>
@endsection
@section('script')
<script src="{{ url('/resources/assets/js/dol-theme.js')}}"></script>
<script src="{{ url('/resources/assets/js/responsivevoice.js')}}"></script>
<!-- <script src="http://code.responsivevoice.org/responsivevoice.js"></script> -->
    <script type="text/javascript">    
        hideConfig();
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
        if($('input[name=speaker]').is(":checked")){
            if($('input[name=soundtype]').is(":checked")){  
                var audio = document.createElement('audio'); 
                audio.id = 'sound1';
                audio.src = $('#sound-track').attr('source');
                $('#sound-track').append(audio);
                if($('i[downAlert=1]').length > 0){
                    $('#sound1')[0].play();
                }  
                setTimeout(function(){                    
                    if($('i[downAlert=1]').length > 0){
                        $('#sound1')[0].play();
                    }                        
                },3500);
                setTimeout(function(){
                    if($('i[downAlert=1]').length > 0){
                        $('#sound1')[0].play();
                    }                        
                },7000);       
            }else{
                if($('#spell p').text() != ''){
                    responsiveVoice.speak($('#spell p').text(),"Thai Female");
                }else{
                    responsiveVoice.speak('getCancle','Thai Female', {volume: 0});
                }                
            }

        }
        $('input[name=speaker]').change(function(){            
            $('#formPerPage').delay(1000).submit();            
        });
        $('input[name=soundtype]').change(function(){            
            $('#formPerPage').delay(1000).submit();            
        });
        function showForm(item){
            $('div[id='+$(item).attr('dat')+']').css('display','block');
        }
        function closeForm(item){
            $('div[id='+$(item).attr('dat')+']').css('display','none');
        }
        function onOtherChange(item){
            var id = $(item).attr('dat');
            $('div[id=comment'+id+']>form>textarea').css('display','block').attr('required','required');
            $('div[id=comment'+id+']>form>textarea').focus();
        }
        $('#blankRadio2, #blankRadio1').change(function(){
            var id = $(this).attr('ind');
            $('div[id=comment'+id+']>form>textarea').css('display','none').removeAttr('required');
        });
        function hideConfig(){
            $('#config1').fadeOut('slow');    
        }
        function showConfig(){
            $('#config1').fadeIn('slow'); 
        }
        function eventConfig(item){
            var status = parseInt($(item).attr('status'));
            if(status == 0){
                showConfig();
                $(item).attr('status','1').attr('class','fa fa-angle-right');
            }else{
                hideConfig();
                $(item).attr('status','0').attr('class','fa fa-cog');
            }
        }

   </script>
@endsection