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
                                WAN 1
                            </a>
                            <div id="collapse{{$i+1}}iii" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                {{$linkData->ip_wan2_1}}
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="8" style="border-right: 1px solid #ddd;">
                            @if(!empty($linkData->cityTel->tel1) || !empty($linkData->cityTel->tel2) || !empty($linkData->cityTel->tel3) || !empty($linkData->cityTel->tel4) || !empty($linkData->cityTel->tel5))
                                <a data-toggle="collapse" href="#collapse{{$i+1}}" role="button" aria-expanded="true" aria-controls="collapse{{$i+1}}" class="btn-block no-decoration"><i class="fa fa-phone"></i> โทรออก</a>
                                <div id="collapse{{$i+1}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    @if(!empty($linkData->cityTel->tel1))
                                        <a href="tel:{{$linkData->cityTel->tel1}}" class="no-decoration label label-primary"><i class="fa fa-phone"></i> {{$linkData->cityTel->tel1}}</a>
                                    @endif
                                    @if(!empty($linkData->cityTel->tel2))
                                        <a href="tel:{{$linkData->cityTel->tel2}}" class="no-decoration label label-primary"><i class="fa fa-phone"></i> {{$linkData->cityTel->tel2}}</a>
                                    @endif
                                </div>
                            @else
                                <a class="text-muted no-decoration">ยังไม่ระบุหมายเลขโทรศัพท์</a>
                            @endif
                        </td>
                        <td colspan="4">
                            <a href="{{url('/linkdata/author')}}/{{$linkData->id}}" class="no-decoration"> 
                                @if($linkData->author->count() != 0)
                                    <i class="fa fa-edit"></i> แก้ไข
                                @else
                                    <i class="fa fa-plus-circle"></i> เพิ่ม
                                @endif
                            </a>
                        </td>
                    </tr>
                @else
                <!-- Amphor List Data -->

                @endif
            @endforeach
        </table>
        
    </div>
</div>
@endsection
@section('script')
    <script src="{{url('/resources/assets/js/main_mobile.js')}}"></script>
    <script type="text/javascript">

    </script>
@endsection