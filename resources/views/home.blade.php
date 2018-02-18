@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12">
    		<div class="col-md-12">    	
    			<h3 class="text-orange">กิจกรรมฝ่ายฯ
    				<span class="text-muted hideIfMobile" style="font-size: 14px; margin-left: 20px;"><span class="badge">วันนี้</span> {{App\CalTime::getTimeNow()}}</span>

    				<a href="#" class="btn btn-sm btn-dark btn-super-curve pull-right">ดูกิจกรรมทั้งหมด</a>
                    @if(Auth::check() && Auth::user()->level >= 6)
                        <a href="{{url('/gallery/index')}}" class="btn btn-sm btn-default btn-super-curve pull-right hideIfMobile" style="margin-right: 10px;"><span class="fa fa-cog"></span> ตั้งค่า</a>
                    @endif
    			</h3>
                @if(Auth::check() && Auth::user()->level >= 6)
                        <a href="{{url('/gallery/index')}}" class="btn btn-sm btn-default btn-super-curve hideIfPC" style="margin-bottom: 10px;"><span class="fa fa-cog"></span> ตั้งค่าแกลเลอรี</a>
                @endif
    		</div>
            <div class="space-10 col-md-12"></div>
    		<div class="col-md-6">
    			<!-- Large item-->
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					      <!-- Indicators 
					      <ol class="carousel-indicators">
					        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
					        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
					      </ol> -->

					      <!-- Wrapper for slides -->
					<div class="carousel-inner">
                        @forelse($galleries as $i => $gallery)
                            @if($i > 5)
        				        <div class="item @if($i == $gCount-1) active @endif">
                                    <img src="@if(!empty($gallery->cover)){{url('/public/images')}}/{{$gallery->cover->image->id}}@else{{url('/resources/images/public/thumb.jpg')}}@endif" alt="...">
                                    <div class="carousel-caption">
                                        <h4 class="inline-nowarp"><a href="{{url('/home/gallery')}}/{{$gallery->id}}">{{$gallery->title}}</a></h4>
                                        <p class="badge" style="background-color: #e9721b">{{App\Caltime::dateThai($gallery->action)}}</p>
                                    </div>
        				        </div>
                            @endif
                        @empty
                            <div class="item active">
                                <img src="{{url('/resources/images/public/thumb.jpg')}}" alt="...">
                                <div class="carousel-caption">
                                    <h4><a href="#">ไม่มีกิจกรรม</a></h4>
                                </div>
                            </div>
                        @endforelse					        
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					      </a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					      </a>
				</div>
    		</div>
    		<div class="col-md-6 hideIfMobile">
    			<!-- Small item-->
                @forelse($galleries2 as $i2 => $gallery2)
                    @if($i2 == 3)
                        <div class="col-md-12 space-30"></div>
                    @endif
                    @if($i2 <= 5)
            			<div class="col-md-4">
            				<img src="@if(!empty($gallery2->cover)){{url('/public/images')}}/{{$gallery2->cover->image->id}}@else{{url('/resources/images/public/thumb.jpg')}}@endif" alt="..." class="col-md-12 no-padding img-thumbnail">
            				<a href="{{url('/home/gallery')}}/{{$gallery2->id}}" class="text-muted no-decoration text-concat"><span class="badge">{{App\Caltime::dateThai($gallery2->action)}}</span> {{$gallery2->title}} </a>
            			</div>
                    @endif
    			@empty
                        <div class="col-md-4">
                            <img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
                            <a href="#" class="text-muted">กิจกรรม 1 ...........................................</a>
                        </div>
                @endforelse    			
    			<!-- Small item-->
    		</div>
        	<div class="space-30 col-md-12 line-orange"></div>

            <div class="col-md-12">     
                <h3 class="text-orange">ข่าวประชาสัมพันธ์
                    <a href="#" class="btn btn-sm btn-dark btn-super-curve pull-right">ดูทั้งหมด</a>
                </h3>   
            </div>
            <div class="col-md-12 space-10"></div>
            <!-- News -->
            <table class="table">
                <tr>
                    <td>1</td>
                    <td><a href="#" class="no-decoration">ชื่อเรื่อง.......................................................</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#" class="no-decoration">ชื่อเรื่อง.......................................................</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" class="no-decoration">ชื่อเรื่อง.......................................................</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" class="no-decoration">ชื่อเรื่อง.......................................................</a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><a href="#" class="no-decoration">ชื่อเรื่อง.......................................................</a></td>
                </tr>
            </table>

    	</div>
    </div>
</div>
@endsection
