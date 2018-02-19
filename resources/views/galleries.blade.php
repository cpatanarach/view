@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12">
    		<div class="col-md-12">       
                <h3 class="text-orange">กิจกรรมฝ่ายฯ
                    <span class="text-muted hideIfMobile" style="font-size: 14px; margin-left: 20px;"><span class="badge">วันนี้</span> {{App\CalTime::getTimeNow()}}</span>

                    @if(Auth::check() && Auth::user()->level >= 6)
                        <a href="{{url('/gallery/index')}}" class="btn btn-sm btn-default btn-super-curve pull-right" style="margin-right: 10px;"><span class="fa fa-cog"></span> ตั้งค่า</a>
                    @endif
                </h3>
            </div>
            <div class="space-10 col-md-12"></div>
            <div class="col-md-12">
                <!-- Small item-->
                @forelse($galleries as $i => $gallery)
                    @if($i == 6 || $i == 12)
                        <div class="col-md-12 space-30 hideIfMobile"></div>
                    @endif

                    <div class="col-md-2">
                        <img src="@if(!empty($gallery->cover)){{url('/public/images')}}/{{$gallery->cover->image->id}}@else{{url('/resources/images/public/thumb.jpg')}}@endif" alt="..." class="col-md-12 no-padding img-thumbnail">
                        <a href="{{url('/home/gallery')}}/{{$gallery->id}}" class="text-muted no-decoration text-concat"><span class="badge">{{App\Caltime::dateThai($gallery->action)}}</span> {{$gallery->title}} </a>
                    </div>
                    <div class="col-md-12 space-10 hideIfPC"></div>
                @empty
                        <div class="col-md-2">
                            <img src="{{url('/resources/images/public/thumb.jpg')}}" alt="..." class="col-md-12 no-padding img-thumbnail">
                            <a href="#" class="text-muted">ไม่พบกิจกรรม</a>
                        </div>
                @endforelse           
                <div class="space-10 col-md-12"></div>
                <!-- Paginate -->
                <div class="col-md-12">{{$galleries->links()}}</div>
            </div>
    	</div>
    </div>
</div>
@endsection
