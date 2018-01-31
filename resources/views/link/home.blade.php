@extends('layouts.app3')

@section('content')
<div class="container">
   	<div class="row">
   		<div id="title-program" class="col-md-12" style="padding: 30px 0px 30px 0px">
   			<h3 class="text-center">สถานะการเชื่อมโยงระบบเครือข่ายสื่อสาร กรมที่ดิน</h3>
   			<h5 class="text-center">ระหว่างศูนย์สารสนเทศที่ดิน กับสำนักงานที่ดินจังหวัด/สาขา/ส่วนแยก/อำเภอ</h5>
   		</div>
       	<div id="table" class="col-md-12 text-center">
           	<table class="table table-hover">
           		<!-- Header of Data -->
                <tr class="text-center bg-info">
                	<td type="province-header" class="col-md-4"><strong>จังหวัด</strong></td>
                  <td type="admin-header" class="col-md-3"><strong>ADMIN</strong></td>    
                  <td type="phone-header" class="col-md-5"><strong>โทรศัพท์</strong></td>
                </tr> 
                <!-- Source -->
                @forelse($allProvince as $province)
                	<tr class="text-centers">
                		<td>
                        <a class="hideIfMobile" href="{{url('/linkCity')}}/{{$province->city_id}}">{{$province->city_name}}</a>
                        <a class="hideIfPC" href="{{url('/linkCity')}}/activeMobileView/{{$province->city_id}}">{{$province->city_name}}</a>
                    </td>
                		<td type="admin">{{$province->cityAdmin->name_admin}} 
                        @if(Auth::user()->level >= ADMIN)
                          <a href="{{url('/cityAdmin/edit')}}/{{$province->cityAdmin->city_id}}" style="margin-left: 10px;"><i class="fa fa-edit"></i></a>
                        @endif
                    </td>

                		<td type="phone">
                        <span data="0" style="display: none;padding-bottom: 5px;">{{$province->cityAdmin->name_admin}}
                            @if(Auth::user()->level >= ADMIN)
                              <a href="{{url('/cityAdmin/edit')}}/{{$province->cityAdmin->city_id}}"><i class="fa fa-edit"></i></a>
                            @endif
                        </span>
                        @if($province->cityAdmin->tel_admin != '-')
                          <a class="label-blank" href="tel:{{$province->cityAdmin->tel_admin}}">
                            <i class="fa fa-phone"></i>
                            <span sim="1">{{$province->cityAdmin->tel_admin}}</span>
                            <span data="1" style="display: none;">{{$province->cityAdmin->status}}</span>
                          </a>
                        @endif
                        @if($province->cityAdmin->tel_admin2 != '-')
                          <a class="label-blank" href="tel:{{$province->cityAdmin->tel_admin2}}" style="margin-top: 6px;">
                            <i class="fa fa-phone"></i>
                            <span sim="2">{{$province->cityAdmin->tel_admin2}}</span>
                            <span data="2" style="display: none;">{{$province->cityAdmin->status}} (สำรอง)</span>
                          </a>
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
@section('script')
  <script src="{{url('/resources/assets/js/main_mobile.js')}}"></script>
  <script type="text/javascript">
    if(isMobile()){
      //If device is mobile
        //for small device
        if(window.screen.width <= 768){
          $('td[type=phone] span[data=0]').css('display','block');
          $('a[class=label-blank]').css('display','block');

          $('a[class=label-blank] span[sim=1]').css('display','none');
          $('a[class=label-blank] span[data=1]').css('display','inline-block');

          $('a[class=label-blank] span[sim=2]').css('display','none');
          $('a[class=label-blank] span[data=2]').css('display','inline-block');
        
          $('td[type=admin-header]').remove();
          $('td[type=admin]').remove();
        
          $('td[type=phone-header]').text('ADMIN');

        }else{
          $('a[class=label-blank] span[sim=1]').css('display','none');
          $('a[class=label-blank] span[data=1]').css('display','inline-block');

          $('a[class=label-blank] span[sim=2]').css('display','none');
          $('a[class=label-blank] span[data=2]').css('display','inline-block');
        }
        $('#title-program h3').css('font-size','18px').css('margin-top','7px').css('margin-bottom','5px');
        $('#title-program').css('padding','10px 0px');
        $('#table').css('padding','0px');
        $('#title-program h5').remove();
    }
  </script>
@endsection