@extends('layouts.app3')
@section('meta')
    <link href="{{ url('/resources/assets/upload/css/dropzone.css') }}" rel="stylesheet">  
@endsection

@section('content')
<div class="container">
    <div class="space-30"></div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{url('/gallery/receive')}}/{{$gallery->id}}" method="POST" enctype="multipart/form-data" class="dropzone text-center" id="my-dropzone">
                {{ csrf_field() }}
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
                <p class="text-center">{{$gallery->title}}</p>
            </form>     
        </div>
    </div>
    <div class="space-10"></div>
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <a href="{{url('/gallery/upload')}}/{{$gallery->id}}" class="btn btn-super-curve btn-default" onclick="getPageLoading();"><i class="fa fa-refresh"></i> Refresh</a>

            <a href="{{url('/gallery/index')}}" class="btn btn-super-curve btn-default" onclick="getPageLoading();"><i class="fa fa-camera-retro"></i> Gallery</a>

            <table class="table text-left" style="margin-top: 10px;">
                @forelse($gallery->images as $image)
                    <tr>
                        <td class="text-center">
                            @if(empty($image->cover->id))
                                <a href="{{url('/gallery/cover/')}}/{{$gallery->id}}/{{$image->id}}" class="btn btn-sm btn-super-curve btn-default" onclick="getPageLoading();"><i class="fa fa-chevron-circle-up"></i><span class="hideIfMobile"> ตั้งเป็นหน้าปก</span></a>
                            @else
                                <a href="#" class="text-success no-decoration"><i class="fa fa-check"></i><span class="hideIfMobile"> หน้าปก </span></a>
                            @endif
                                <a href="{{url('/gallery/image/destroy')}}/{{$image->id}}" class="btn btn-sm btn-super-curve btn-default" style="margin-top: 30px;" onclick="getPageLoading();"><i class="fa fa-trash text-danger"></i><span class="hideIfMobile"> ลบรูป</span></a>
                        </td>
                        <td>
                            <img src="{{url('/public/images')}}/{{$image->id}}" class="img-responsive">
                        </td>
                    </tr>
                @empty
                    <p>ยังไม่อัพโหลดรูป</p>
                @endforelse
            </table>
        </div>        
    </div>
</div>
@endsection

@section('script')
    <script src="{{url('/resources/assets/upload/js/dropzone.js')}}"></script>
    <script type="text/javascript">
        function getPageLoading(){
            $('#pageLoading').css('display','block');
        }
        Dropzone.options.myDropzone = {
            paramName: 'file',
            maxFilesize: 5, // MB
            maxFiles: 50,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                this.on("success", function(file, response) {
                    var a = document.createElement('span');
                    a.className = "thumb-url btn btn-primary";
                    a.setAttribute('data-clipboard-text','{{url('/uploads')}}'+'/'+response);
                    a.innerHTML = "copy url";
                    file.previewTemplate.appendChild(a);
                });
            }
        };
    </script>
@endsection