@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12 space-30">
    		<div class="col-md-5">
                <img src="@if(!empty($gallery->cover)){{url('/public/images')}}/{{$gallery->cover->image->id}}@else{{url('/resources/images/public/thumb.jpg')}}@endif" alt="..." class="col-md-12 no-padding img-thumbnail">
            </div>
            <div class="col-md-7">
                <h4 style="line-height: 1.3;">{{$gallery->title}}</h4>
                <div class="col-md-12 no-padding">
                    <span class="badge">{{App\Caltime::dateThai($gallery->action)}}</span>
                    <a href="#" class="btn btn-xs btn-super-curve btn-info"><span class="fa fa-facebook"></span> facebook</a>
                    <a href="#" class="btn btn-xs btn-super-curve btn-primary"><span class="fa fa-twitter"></span> Twitter&nbsp</a>
                    @if(Auth::check() && Auth::user()->level >= 6)
                        <a href="{{url('/gallery/upload')}}/{{$gallery->id}}" class="btn btn-xs btn-super-curve btn-default"><span class="fa fa-upload"></span> Upload&nbsp</a>
                    @endif
                </div>
                <div class="col-md-12 space-10"></div>
                <article >
                    <p class="text-justify">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$gallery->discription}}</p>
                </article>
            </div>
    	</div>
        <div class="col-md-12 space-10"></div>
        
    </div>
</div>
@endsection
