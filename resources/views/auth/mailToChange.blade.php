@extends('layouts.app3')

@section('content')
	<h4 class="label label-success text-center">ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ กรมที่ดิน</h4>
	<div class="space-30"></div>
	<div class="col-md-8 col-md-offset-2">
		<ul>เรียน คุณ {{$user->firstname}}&nbsp&nbsp{{$user->lastname}}
			<article>
				<li> นี่คือขั้นตอนการยืนยันการใช้งานอีเมล เพื่อติดต่อรับข่าวสารจากฝ่ายปฏิบัติการคอมพิวเตอร์ <li> 
				<li> คลิกยืนยันเพื่อดำเนินการต่อ</li>					
		</article>
		</ul>
		<div class="dol-md-12 text-center">
			<a target="_blank" href="{{url('/email/accept')}}/{{$ref}}" class="btn btn-success">ยืนยัน</a>
		</div>
		ถ้าไม่สามารถคลิก "ยืนยัน" กรุณาคัดลอก <a target="_blank" href="{{url('/email/accept')}}/{{$ref}}">{{url('/email/accept')}}/{{$ref}}</a> ไปวางยังเว็บเบราเซอร์แทน
	</div>
	<h2 class="text-center"><p class="text-muted"><span class="fa fa-copyright"></span> | Computer Operator Section</p></h2>
@endsection