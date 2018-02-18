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
                    <form type="gallery" class="form-horizontal" role="form" method="POST" action="{{url('/gallery/store')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">หัวข้อ</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  placeholder="หัวข้อเรื่อง" required autofocus>

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
                                <textarea rows="5" name="discription" class="form-control" placeholder="คำอธิบายรายละเอียดของกิจกรรม">
                                    
                                </textarea>

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
                                <label class="radio-inline"><input type="radio" name="publish" value="1" @if(old('publish') == '1') checked @endif >เผยแพร่</label>
                                <label class="radio-inline"><input type="radio" name="publish" value="0" @if(old('publish') == '0') checked @endif >ไม่เผยแพร่</label>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('action') ? ' has-error' : '' }}">
                            <label for="action" class="col-md-4 control-label">วันที่</label>

                            <div class="col-md-3">
                                <input id="action" type="date" class="form-control" name="action" value="{{ old('action') }}"  placeholder="กิจกรรมเมื่อวันที่" required >

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
                                    <i class="fa fa-plus"></i>
                                    สร้างแกลเลอรี
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="space-10"></div>
            <table class="table">
                @forelse($galleries as $i => $gallery)
                    <tr>
                        <td>
                            @if($gallery->publish)
                                <span class="fa fa-eye"></span>
                            @else
                                <span class="fa fa-eye-slash"></span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/gallery/edit')}}/{{$gallery->id}}" class="no-decoration">{{$gallery->title}}</a>
                        </td>
                        <td>
                            <form forGalleryDestroy="{{$gallery->id}}"  class="form-inline" action="{{url('/gallery/destroy')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="ref" value="{{$gallery->id}}">
                                <button type="button" class="btn btn-sm btn-super-curve btn-default pull-right" data-toggle="modal" data-target="#myModal{{$gallery->id}}"><span class="fa fa-trash-o"></span> ลบ</button>

                                <!-- Modal -->
                                  <div class="modal fade" id="myModal{{$gallery->id}}" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Woops!</h4>
                                        </div>
                                        <div class="modal-body">
                                          <p>คุณต้องการลบข้อมูล "{{$gallery->title}}" ออกจากระบบหรือไม่</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="destroyGallery({{$gallery->id}});">ลบแกลเลอรี</button>
                                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </div>  
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            ไม่พบแกลเลอรี
                        </td>
                    </tr>
                @endforelse  
                {{ $galleries->links() }}              
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function destroyGallery(id){
            $('form[forGalleryDestroy='+ id + ']').submit();
            getPageLoading();
        }
        $( "form[type=gallery]" ).submit(function( event ) {
          getPageLoading();
        });
        function getPageLoading(){
            $('#pageLoading').css('display','block');
        }
    </script>
@endsection