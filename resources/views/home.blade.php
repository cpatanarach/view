@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12">
    		<div class="col-md-12">    	
    			<h3 class="text-orange">กิจกรรมฝ่ายฯ
    				<span class="text-muted hideIfMobile" style="font-size: 14px; margin-left: 20px;"><span class="badge">วันนี้</span> {{App\CalTime::getTimeNow()}}</span>
    				<a href="#" class="btn btn-sm btn-dark btn-super-curve pull-right">ดูกิจกรรมทั้งหมด</a>
    			</h3>	
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
					      </ol>-->

					      <!-- Wrapper for slides -->
					      <div class="carousel-inner">
					        <div class="item active">
					          <img src="{{url('/resources/images/test/01.jpg')}}" alt="...">
					          <div class="carousel-caption">
					             <h4><a href="{{url('/')}}">ปฏบัติงาน ณ สำนักงานที่ดินจังหวัดสุโขทัย สาขาสวรรคโลก</a></h4>
					          </div>
					        </div>
					        <div class="item">
					          <img src="{{url('/resources/images/test/002.jpg')}}" alt="...">
					          <div class="carousel-caption">
					             <h4><a href="{{url('/')}}">ปฏบัติงาน ณ สำนักงานที่ดินจังหวัดสุโขทัย สาขาศรีศัชนาลัย</a></h4>
					          </div>
					        </div>
					        <div class="item">
					          <img src="{{url('/resources/images/test/03.jpg')}}" alt="...">
					          <div class="carousel-caption">
					            <h4><a href="{{url('/')}}">ปฏบัติงาน ณ สำนักงานที่ดินจังหวัดสุโขทัย สาขาศรีสำโรง</a></h4>
					          </div>
					        </div>
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
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 1 ...........................................</a>
    			</div>
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 2 ...........................................</a>
    			</div>
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 3 ...........................................</a>
    			</div>

    			<div class="col-md-12 space-30"></div>


    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 4 ...........................................</a>
    			</div>
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 5 ...........................................</a>
    			</div>
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 6 ...........................................</a>
    			</div>

    			<div class="col-md-12 space-30"></div>


    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 7 ...........................................</a>
    			</div>
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 8 ...........................................</a>
    			</div>
    			<div class="col-md-4">
    				<img src="http://academic.udru.ac.th/~culture/wp-content/uploads/2016/04/no-thumbnail.png" alt="..." class="col-md-12 no-padding img-thumbnail">
    				<a href="#" class="text-muted">กิจกรรม 9 ...........................................</a>
    			</div>
    			<!-- Small item-->
    		</div>
        	<div class="space-30 col-md-12"></div>
    	</div>
    </div>
</div>
@endsection
