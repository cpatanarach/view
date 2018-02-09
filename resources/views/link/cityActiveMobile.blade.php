@extends('layouts.app_no_bar')
@section('meta')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <table class="table table-hover">
            @foreach($city->linkData as $i => $linkData)
                @if(strpos($linkData->city_name1, 'อำเภอ') === FALSE)
                    <tr class="text-center text-info">
                        <td colspan="12">
                            <div class="col-md-12 space-10"></div>
                            <span class="badge">{{$i+1}}</span> สำนักงานที่ดิน@if($city->city_id != 1)จังหวัด@endif{{$linkData->city_name1}}
                            <div class="col-md-12 space-10"></div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="4" class="@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'GateWay'],])->count()) bg-offline @else bg-online @endif" style="border-right: 1px solid #ddd;">
                            <a data-toggle="collapse" href="#collapse{{$i+1}}i" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}i" class="no-decoration text-white">
                                Gateway
                            </a>
                            <div id="collapse{{$i+1}}i" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                {{$linkData->ip_gw}}
                            </div>
                        </td>
                        <td colspan="4" class="@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan1'],])->count()) bg-offline @else bg-online @endif" style="border-right: 1px solid #ddd;">
                            <a data-toggle="collapse" href="#collapse{{$i+1}}ii" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}ii" class="no-decoration text-white">
                                WAN 1
                            </a>
                            <div id="collapse{{$i+1}}ii" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                {{$linkData->ip_wan1_1}}
                            </div>
                        </td>
                        <td colspan="4" class="@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan2'],])->count()) bg-offline @else bg-online @endif">
                            <a data-toggle="collapse" href="#collapse{{$i+1}}iii" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}iii" class="no-decoration text-white">
                                WAN 2
                            </a>
                            <div id="collapse{{$i+1}}iii" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                {{$linkData->ip_wan2_1}}
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="8" style="border-right: 1px solid #ddd;">
                            @if($linkData->author->count() != 0)
                                <a data-toggle="collapse" href="#collapse{{$i+1}}" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}" class="btn-block no-decoration"><i class="fa fa-phone"></i> โทรออก</a>
                                <div id="collapse{{$i+1}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    @foreach($linkData->author as $author)
                                        <a href="tel:{{$author->number}}" class="btn btn-block btn-success">@if($author->type == 1) <i class="fa fa-tty"></i> @elseif($author->type == 2) <i class="fa fa-fax"></i> @elseif($author->type == 3) <i class="fa fa-user-circle"></i> @elseif($author->type == 4) <i class="fa fa-microphone"></i> @elseif($author->type == 5) <i class="fa fa-file-video-o"></i> @endif {{$author->name}} 
                                        <span class="btn-under">{{$author->number}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <a class="text-muted no-decoration">ยังไม่ระบุหมายเลขโทรศัพท์</a>
                            @endif
                        </td>
                        <td colspan="4" style="vertical-align: middle;">
                            <a href="{{url('/linkdata/author')}}/{{$linkData->id}}" class="no-decoration"> 
                                @if($linkData->author->count() != 0)
                                    <i class="fa fa-cogs"></i> ตั้งค่า
                                @else
                                    <i class="fa fa-plus"></i> เพิ่ม
                                @endif                    
                            </a>
                        </td>
                    </tr>
                @else
                <!-- Amphor List Data -->
                    <tr class="text-center text-info">
                        <td colspan="12">
                            <div class="col-md-12 space-10"></div>
                            <span class="badge">{{$i+1}}</span> สำนักงานที่ดิน@if($city->city_id != 1)จังหวัด@endif{{$linkData->city_name1}}
                            <div class="col-md-12 space-10"></div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="8" class="@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'GateWay'],])->count()) bg-offline @else bg-online @endif" style="border-right: 1px solid #ddd;">
                            <a data-toggle="collapse" href="#collapse{{$i+1}}i" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}i" class="no-decoration text-white">
                                Gateway
                            </a>
                            <div id="collapse{{$i+1}}i" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                {{$linkData->ip_gw}}
                            </div>
                        </td>
                        <td colspan="4" class="@if(App\LinkDown::where([['city_id','=', $linkData->id],['job_down','=','OFF'],['link_status', '=', 'Wan1'],])->count()) bg-offline @else bg-online @endif" style="border-right: 1px solid #ddd;">
                            <a data-toggle="collapse" href="#collapse{{$i+1}}ii" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}ii" class="no-decoration text-white">
                                WAN 1
                            </a>
                            <div id="collapse{{$i+1}}ii" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                {{$linkData->ip_wan1_1}}
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="8" style="border-right: 1px solid #ddd;">
                            @if($linkData->author->count() != 0)
                                <a data-toggle="collapse" href="#collapse{{$i+1}}" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}" class="btn-block no-decoration"><i class="fa fa-phone"></i> โทรออก</a>
                                <div id="collapse{{$i+1}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    @foreach($linkData->author as $author)
                                        <a href="tel:{{$author->number}}" class="btn btn-block btn-success">@if($author->type == 1) <i class="fa fa-tty"></i> @elseif($author->type == 2) <i class="fa fa-fax"></i> @elseif($author->type == 3) <i class="fa fa-user-circle"></i> @elseif($author->type == 4) <i class="fa fa-microphone"></i> @elseif($author->type == 5) <i class="fa fa-file-video-o"></i> @endif {{$author->name}} 
                                        <span class="btn-under">{{$author->number}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <a class="text-muted no-decoration">ยังไม่ระบุหมายเลขโทรศัพท์</a>
                            @endif
                        </td>
                        <td colspan="4" style="vertical-align: middle;">
                            <a href="{{url('/linkdata/author')}}/{{$linkData->id}}" class="no-decoration"> 
                                @if($linkData->author->count() != 0)
                                    <i class="fa fa-cogs"></i> ตั้งค่า
                                @else
                                    <i class="fa fa-plus"></i> เพิ่ม
                                @endif                    
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                @if(Auth::user()->level >= SUPERUSER)
                    <td colspan="12" class="text-center"><a href="{{url('/linkHome')}}"><span class="fa fa-chevron-left"></span> ย้อนกลับ</a></td>
                @else
                    <td colspan="12" class="text-center"><a href="{{url('/home')}}"><span class="fa fa-home"></span> หน้าหลัก</a></td>
                @endif
            </tr>
        </table>
        
    </div>
</div>
@endsection
@section('script')
    <script src="{{url('/resources/assets/js/main_mobile.js')}}"></script>
    <script type="text/javascript">

    </script>
@endsection