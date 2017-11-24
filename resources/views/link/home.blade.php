@extends('layouts.app3')

@section('content')
<div class="container">
   	<div class="row">
   		<div class="col-md-12" style="padding: 30px 0px 30px 0px">
   			<h3 class="text-center">สถานะการเชื่อมโยงระบบเครือข่ายสื่อสาร กรมที่ดิน</h3>
   			<h5 class="text-center">ระหว่างศูนย์สารสนเทศที่ดิน กับสำนักงานที่ดินจังหวัด/สาขา/ส่วนแยก/อำเภอ</h5>
   		</div>
       	<div class="col-md-12 text-center">
           	<table class="table table-hover">
           		<!-- Header of Data -->
                <tr class="text-center bg-info">
                	<td class="col-md-1"><strong>ลำดับที่</strong></td>
                	<td class="col-md-3"><strong>จังหวัด</strong></td>
                    <td class="col-md-2"><strong>ผู้ดูแล</strong></td>
                    <td class="col-md-3"><strong>ADMIN</strong></td>    
                    <td class="col-md-3"><strong>โทรศัพท์</strong></td>
                </tr> 
                <!-- Source -->
                @forelse($allProvince as $i => $province)
                	<tr class="text-centers">
                		<td>{{$i+1}}</td>
                		<td><a href="{{url('/linkCity')}}/{{$province->city_id}}">{{$province->city_name}}</a></td>
                		<td>{{$province->linkData->first()->job_name}}</td>
                		<td>{{$province->cityAdmin->name_admin}} ({{$province->cityAdmin->status}})</td>
                		<td>{{$province->cityAdmin->tel_admin}}
                				@if(Auth::user()->level >= ADMIN)
                					<a href="{{url('/cityAdmin/edit')}}/{{$province->cityAdmin->city_id}}" style="margin-left: 10px;"><i class="fa fa-edit"></i></a>
                				@endif
                		</td>
                	</tr>
                @empty
                	<tr class="text-center"><td colspan="5" class="text-danger">ไม่พบข้อมูล</td></tr>
                @endforelse
         	</table>
       	</div>
   </div>
</div>
@endsection
