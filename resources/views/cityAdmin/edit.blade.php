@extends('layouts.app3')

@section('content')
<div class="container">
   	<div class="row">
   		<div class="col-md-12" style="padding: 30px 0px 30px 0px">
   			<h3 class="text-center">สำนักงานที่ดิน@if($adminInfo->city_id > 1)จังหวัด@endif{{$adminInfo->city_name}}</h3>
   			<h5 class="text-center">บันทึกข้อมูลโดย {{Auth::user()->firstname}} {{Auth::user()->lastname}}</h5>
   		</div>
       	<div class="col-md-12">
           	<form id="formAdminInfo" class="form-horizontal" role="form" method="POST" action="{{url('/cityAdmin/update')}}">
                        {{ csrf_field() }}
                <input type="hidden" name="ref" value="{{$adminInfo->city_id}}">
                <input type="hidden" name="name_admin" value="{{$adminInfo->name_admin}}">
                <!--<input type="hidden" name="tel_admin" value="{{$adminInfo->tel_admin}}">-->
               	<div class="form-group">
                    <label for="firstname" class="col-md-2 control-label">ชื่อ</label>

                   	<div class="col-md-3">
                   	    <input id="firstname" type="text" class="form-control" name="firstname" placeholder="ชื่อ" required>
                    </div>

                    <label for="lastname" class="col-md-1 control-label">สกุล</label>

                   	<div class="col-md-3">
                   	    <input id="lastname" type="text" class="form-control" name="lastname" placeholder="สกุล">
                    </div>

                    <label for="status" class="col-md-1 control-label">ชื่อเล่น</label>

                   	<div class="col-md-2">
                   	    <input id="status" type="text" class="form-control" name="status" placeholder="สกุล" value="{{$adminInfo->status}}">
                    </div>
                </div>   
                <div class="form-group">
                    <label for="tel1" class="col-md-2 control-label">โทรศัพท์ 1</label>

                   	<div class="col-md-3">
                   	    <input id="tel1" type="text" class="form-control bfh-phone" name="tel_admin" placeholder="หมายเลขโทรศัพท์" data-format="dd dddd dddd" value="{{$adminInfo->tel_admin}}">
                    </div>

                    <label for="tel2" class="col-md-1 control-label">โทรศัพท์ 2</label>

                   	<div class="col-md-3">
                   	    <input id="tel2" type="text" class="form-control bfh-phone" name="tel_admin2" placeholder="หมายเลขโทรศัพท์" data-format="dd dddd dddd" value="{{$adminInfo->tel_admin2}}">
                    </div>

                    <div class="col-md-2 col-md-offset-1">
                                <button id="update" type="button" class="btn btn-primary btn-block">
                                    <i class="fa fa-user-circle-o"> &nbsp</i>
                                    อัพเดท
                                </button>
                    </div>
                </div>
                
            </form>
       	</div>
   </div>
</div>
@endsection
@section('script')
    <!-- SCRIPT -->
    <script src="{{ url('/resources/assets/formhelper/bootstrap-formhelpers-phone.js') }}"></script>
    <script type="text/javascript">
    	//On Event Document Loaded
    	var name_admin = '';
    	var tel_admin = '';
    	$(document).ready(function(){
    		getAdminInfo();
    		splitInfo();
    	});
    	$('#update').click(function(){
    		var telSplit = '';
    		if($('input[name=firstname]').val().length === 0){$('input[name=firstname]').val('ว่าง');}
    		if($('input[name=status]').val().length === 0){$('input[name=status]').val('-');}
    		if($('input[name=tel_admin]').val().length === 0){$('input[name=tel_admin]').val('-');}
        if($('input[name=tel_admin2]').val().length === 0){$('input[name=tel_admin2]').val('-');}
    		$('input[name=name_admin]').val($('input[name=firstname]').val().trim()+' '+$('input[name=lastname]').val().trim());
    		//$('input[name=tel_admin]').val($('input[name=tel1]').val()+telSplit+ $('input[name=tel2]').val());
    		setTimeout(function(){
    			$('#formAdminInfo').submit();
    		}, 500);
    	});
    	function getAdminInfo(){
    		name_admin = $('input[name=name_admin]').val();
    		tel_admin = $('input[name=tel_admin]').val();
    	}
    	function splitInfo(){
    		var name = name_admin.split(' ');
    		var tel = tel_admin.split(',');
    		$('input[name=firstname]').val(name[0].trim());
    		$('input[name=lastname]').val(name[1].trim());

    		//$('input[name=tel_admin]').val(tel[0].trim());
    		//$('input[name=tel_admin2]').val(tel[1].trim());
    	}
    </script>
@endsection
