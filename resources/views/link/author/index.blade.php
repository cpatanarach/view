@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="space-30"></div>
    	<div class="panel panel-default">
    		<div class="panel-heading">รายชื่อผู้ติดต่อสำนักงานที่ดิน@if($linkData->city->id == 1)จังหวัด@endif{{$linkData->city_name1}}</div>
    		<div class="panel-body">
    			@if(Session::has('success'))
    				<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> บันทึกข้อมูลสำเร็จ</div>
    			@endif
    			@if(Session::has('errors'))
    				<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> กรุณาตรวจสอบการกรอกข้อมูล</div>
    			@endif
    				<div id="form-loading" class="alert alert-info text-center" style="display: none;"><i class="fa fa-spinner fa-spin"></i> กรุณารอสักครู่</div>
	    		<form id="formAuthor" class="form-inline" role="form" method="POST" action="{{url('/linkdata/author/add')}}">
	            	{{ csrf_field() }}
	            	<input type="hidden" name="ref" value="{{$linkData->id}}">
	            	<div class="form-group col-md-3 {{ $errors->has('name') ? ' has-error' : '' }}">
	            		<label for="name" class="control-label">รายชื่อ</label>            		
	                   	<input id="name" type="text" class="form-control" name="name" placeholder="ชื่อผู้ติดต่อ" value="{{old('name')}}" required> 
	                   	@if ($errors->has('name'))
                           	<span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif             
	            	</div>
	            	<div class="form-group col-md-3">
	            		<label for="type" class="control-label">ประเภท</label>
	            		<select id="type" class="form-control" name="type">
	            			<option value="1" @if(old('type')==1) selected @endif >สำนักงาน</option>
	            			<option value="2" @if(old('type')==2) selected @endif >โทรสาร</option>
	            			<option value="3" @if(old('type')==3) selected @endif >มือถือ</option>
	            			<option value="4" @if(old('type')==4) selected @endif >Voice Phone</option>
	            			<option value="5" @if(old('type')==5) selected @endif >Video Phone</option>
	            		</select>
	            	</div>
	            	<div class="form-group col-md-4">
	            		<div id="number1" @if(old('type')!=1 && !empty(old('type'))) style="display: none" @endif class="input-group {{ $errors->has('number1') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-tty"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number1" placeholder="x xxxx xxxx" data-format="d dddd dddd" value="{{old('number1')}}">
	            			
	            		</div>
	            		<div id="number2" @if(old('type')!=2) style="display: none" @endif class="input-group {{ $errors->has('number2') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-fax"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number2" placeholder="x xxxx xxxx" data-format="d dddd dddd" value="{{old('number2')}}">
	            			
	            		</div>
	            		<div id="number3" @if(old('type')!=3) style="display: none" @endif class="input-group {{ $errors->has('number3') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mobile"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number3" placeholder="xx xxxx xxxx" data-format="dd dddd dddd" value="{{old('number3')}}">
	            			
	            		</div>
	            		<div id="number4" @if(old('type')!=4) style="display: none" @endif class="input-group {{ $errors->has('number4') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-microphone"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number4" placeholder="xxxxxx" data-format="dddddd" value="{{old('number4')}}">
	            			
	            		</div>
	            		<div id="number5" @if(old('type')!=5) style="display: none" @endif class="input-group {{ $errors->has('number5') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-file-video-o"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number5" placeholder="xxxxxx" data-format="dddddd" value="{{old('number5')}}">
	            			
	            		</div>
	            	</div>
	            	<div class="form-group col-md-2">
	            		<button type="submit" class="btn btn-block btn-primary">
	            			<i class="fa fa-plus-circle"></i> เพิ่มรายชื่อ
	            		</button>
	            	</div>
	            </form>
	            <!-- Form for Edit -->
	        </div>
    	</div>
    	<div class="space-10"></div>
    		@if(Session::has('deleted'))
    			<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ลบข้อมูลสำเร็จ</div>
    		@endif

	        @forelse($linkData->author as $i => $author)
		        <div class="panel panel-default col-md-5 @if($i%2==1) col-md-offset-2 @endif">
		        	<div class="panel-body">
		        		<a href="tel:{{$author->number}}" class="btn btn-block btn-success">@if($author->type == 1) <i class="fa fa-tty"></i> @elseif($author->type == 2) <i class="fa fa-fax"></i> @elseif($author->type == 3) <i class="fa fa-user-circle"></i> @elseif($author->type == 4) <i class="fa fa-microphone"></i> @elseif($author->type == 5) <i class="fa fa-file-video-o"></i> @endif {{$author->name}} 
		        			<span class="btn-under">{{$author->number}}</span>
		        		</a>
		        		<div class="btn-block text-center">
		        			<a href="{{url('/linkdata/author/edit')}}/{{$author->id}}" class="text-center no-decoration" onclick="getPageLoading();" style="padding-right: 10px;"><i class="fa fa-edit"></i> แก้ไข</a>
		        			<a href="#" class="text-center text-danger no-decoration" style="padding-left: 10px;" item="remove-author" action="{{url('/linkdata/author/remove')}}/{{$linkData->id}}/{{$author->id}}" confirm="{{$author->name}}"><i class="fa fa-close"></i> ลบข้อมูล</a>
		        		</div>
		        	</div>	        		
		        </div>
	        @empty
	        	<div class="panel panel-default">
	        		<div class="panel-body text-center">
	        			<p class="text-danger">ไม่มีรายชื่อผู้ติดต่อ</p>
	        		</div>
	        	</div>
	        @endforelse        
    </div>
</div>
@endsection
@section('script')
	<script src="{{ url('/resources/assets/formhelper/bootstrap-formhelpers-phone.js') }}"></script>
	<script type="text/javascript">
		$('#type').change(function(){
			if($(this).val()==1){
				$('#number1').css("display","inline-table");
				$('#number2').css("display","none");
				$('#number3').css("display","none");
				$('#number4').css("display","none");
				$('#number5').css("display","none");
			}else if($(this).val()==2){
				$('#number1').css("display","none");
				$('#number2').css("display","inline-table");
				$('#number3').css("display","none");
				$('#number4').css("display","none");
				$('#number5').css("display","none");
			}else if($(this).val()==3){
				$('#number1').css("display","none");
				$('#number2').css("display","none");
				$('#number3').css("display","inline-table");
				$('#number4').css("display","none");
				$('#number5').css("display","none");
			}else if($(this).val()==4){
				$('#number1').css("display","none");
				$('#number2').css("display","none");
				$('#number3').css("display","none");
				$('#number4').css("display","inline-table");
				$('#number5').css("display","none");
			}else if($(this).val()==5){
				$('#number1').css("display","none");
				$('#number2').css("display","none");
				$('#number3').css("display","none");
				$('#number4').css("display","none");
				$('#number5').css("display","inline-table");

			}
		});
		$('a[item=remove-author]').click(function(){
			var cfm = confirm('คุณต้องการลบข้อมูล '+ $(this).attr('confirm') + ' ใช่หรือไม่');
			if(cfm){window.location = $(this).attr('action');$('#pageLoading').css('display','block');}
		});
		$('form').submit(function(){
			$('#form-loading').css('display','block');
		});
		function getPageLoading(){
			$('#pageLoading').css('display','block');
		}
	</script>
@endsection