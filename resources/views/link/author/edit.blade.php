@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="space-30"></div>
    	<div class="panel panel-default">
    		<div class="panel-heading"><a href="{{url('/linkdata/author')}}/{{$author->linkData->id}}" onclick="getPageLoading();"><i class="fa fa-chevron-left"></i></a> รายชื่อผู้ติดต่อสำนักงานที่ดิน@if($author->linkData->city->city_id == 1)จังหวัด@endif{{$author->linkData->city_name1}}</div>
    		<div class="panel-body">
    			@if(Session::has('success'))
    				<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> บันทึกข้อมูลสำเร็จ</div>
    			@endif
    			@if(Session::has('errors'))
    				<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> กรุณาตรวจสอบการกรอกข้อมูล</div>
    			@endif
    				<div id="form-loading" class="alert alert-info text-center" style="display: none;"><i class="fa fa-spinner fa-spin"></i> กรุณารอสักครู่</div>
	    		<form id="formAuthor" class="form-inline" role="form" method="POST" action="{{url('/linkdata/author/update')}}">
	            	{{ csrf_field() }}
	            	<input type="hidden" name="ref" value="{{$author->id}}">
	            	<div class="form-group col-md-3 {{ $errors->has('name') ? ' has-error' : '' }}">
	            		<label for="name" class="control-label">รายชื่อ</label>            		
	                   	<input id="name" type="text" class="form-control" name="name" placeholder="ชื่อผู้ติดต่อ" value="@if(old('name')){{old('name')}}@else{{$author->name}}@endif" required> 
	                   	@if ($errors->has('name'))
                           	<span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif             
	            	</div>
	            	<div class="form-group col-md-3">
	            		<label for="type" class="control-label">ประเภท</label>
	            		<select id="type" class="form-control" name="type">
	            			<option value="1" @if(old('type')==1 || (empty(old('type')) && $author->type == 1)) selected @endif>สำนักงาน</option>
	            			<option value="2" @if(old('type')==2 || (empty(old('type')) && $author->type == 2)) selected @endif>โทรสาร</option>
	            			<option value="3" @if(old('type')==3 || (empty(old('type')) && $author->type == 3)) selected @endif>มือถือ</option>
	            			<option value="4" @if(old('type')==4 || (empty(old('type')) && $author->type == 4)) selected @endif>Voice Phone</option>
	            			<option value="5" @if(old('type')==5 || (empty(old('type')) && $author->type == 5)) selected @endif>Video Phone</option>
	            		</select>
	            	</div>
	            	<div class="form-group col-md-4">
	            		<div id="number1" @if((old('type')!=1 && !empty(old('type'))) || (empty(old('type')) && $author->type != 1)) style="display: none" @endif class="input-group {{ $errors->has('number1') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-tty"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number1" placeholder="x xxxx xxxx" data-format="d dddd dddd" value="@if(old('number1')){{old('number1')}}@elseif($author->type==1){{$author->number}}@endif">
	            			
	            		</div>
	            		<div id="number2" @if((old('type')!=2 && !empty(old('type'))) || (empty(old('type')) && $author->type != 2)) style="display: none" @endif class="input-group {{ $errors->has('number2') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-fax"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number2" placeholder="x xxxx xxxx" data-format="d dddd dddd" value="@if(old('number2')){{old('number2')}}@elseif($author->type==2){{$author->number}}@endif">
	            			
	            		</div>
	            		<div id="number3" @if((old('type')!=3 && !empty(old('type'))) || (empty(old('type')) && $author->type != 3)) style="display: none" @endif class="input-group {{ $errors->has('number3') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mobile"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number3" placeholder="xx xxxx xxxx" data-format="dd dddd dddd" value="@if(old('number3')){{old('number3')}}@elseif($author->type==3){{$author->number}}@endif">
	            			
	            		</div>
	            		<div id="number4" @if((old('type')!=4 && !empty(old('type'))) || (empty(old('type')) && $author->type != 4)) style="display: none" @endif class="input-group {{ $errors->has('number4') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-microphone"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number4" placeholder="xxxxxx" data-format="dddddd" value="@if(old('number4')){{old('number4')}}@elseif($author->type==4){{$author->number}}@endif">
	            			
	            		</div>
	            		<div id="number5" @if((old('type')!=5 && !empty(old('type'))) || (empty(old('type')) && $author->type != 5)) style="display: none" @endif class="input-group {{ $errors->has('number5') ? ' has-error' : '' }}">
	            			<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-file-video-o"></i></span>
	            			<input type="text" class="form-control bfh-phone" name="number5" placeholder="xxxxxx" data-format="dddddd" value="@if(old('number5')){{old('number5')}}@elseif($author->type==5){{$author->number}}@endif">		
	            		</div>
	            	</div>
	            	<div class="form-group col-md-2">
	            		<button type="submit" class="btn btn-block btn-primary">
	            			<i class="fa fa-save"></i> บันทึก
	            		</button>
	            	</div>
	            </form>
	            <!-- Form for Edit -->
	        </div>
    	</div>      
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
		$('form').submit(function(){
			$('#form-loading').css('display','block');
		});
		function getPageLoading(){
			$('#pageLoading').css('display','block');
		}
	</script>
@endsection