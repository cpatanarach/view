@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 space-30">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="fa fa-check"></span> {{Session::get('success')}}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Gallery Management</div>
                <div class="panel-body">
                    <form type="gallery" class="form-horizontal" role="form" method="POST" action="{{url('/gallery/update')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="ref" value="{{$gallery->id}}">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">หัวข้อ</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="@if(!empty(old('title'))){{old('title')}}@else{{$gallery->title}}@endif"  placeholder="หัวข้อเรื่อง" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('discription') ? ' has-error' : '' }}">
                            <label for="discription" class="col-md-4 control-label">คำอธิบาย</label>

                            <div class="col-md-6">
                                <textarea rows="5" name="discription" class="form-control" placeholder="คำอธิบายรายละเอียดของกิจกรรม">@if(!empty(old('discription'))){{old('discription')}}@else{{$gallery->discription}}@endif</textarea>

                                @if ($errors->has('discription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('publish') ? ' has-error' : '' }}">
                            <label for="publish" class="col-md-4 control-label">สถานะ</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="publish" value="1" @if(old('publish') == '1' || (empty(old('publish')) && $gallery->publish == '1')) checked @endif >เผยแพร่</label>
                                <label class="radio-inline"><input type="radio" name="publish" value="0" @if(old('publish') == '0' || (empty(old('publish')) && $gallery->publish == '0')) checked @endif >ไม่เผยแพร่</label>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('action') ? ' has-error' : '' }}">
                            <label for="action" class="col-md-4 control-label">วันที่</label>

                            <div class="col-md-3">
                                <input id="action" type="date" class="form-control" name="action" value="@if(!empty(old('action'))){{old('action')}}@else{{$gallery->action}}@endif"  placeholder="กิจกรรมเมื่อวันที่" required >

                                @if ($errors->has('action'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('action') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    บันทึก
                                </button>
                                <a href="{{url('/gallery/upload')}}/{{$gallery->id}}" class="btn btn-default"><i class="fa fa-upload" onclick="getPageLoading();"></i> อัพโหลดรูป</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="space-10"></div>            
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $( "form[type=gallery]" ).submit(function( event ) {
          getPageLoading();
        });
        function getPageLoading(){
            $('#pageLoading').css('display','block');
        }
    </script>
@endsection