@extends('layouts.app_no_bar')
	@section('meta')
    	<meta http-equiv="refresh" content="3000"/>
	@endsection
@section('content')
<div class="container">
	<div class="col-sm-12">
		<form method="GET" action="{{url('/viewLink')}}">
    		<div class="input-group">
      			<input name="search" type="text" class="form-control" placeholder="ค้นหาจังหวัด...">
      			<span class="input-group-btn">
        			<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
      			</span>
    		</div><!-- /input-group -->
    	</form>
  	</div><!-- /.col-lg-6 -->
</div>
	@forelse($allProvince as $i => $province)
		<div class="container">
			<p>{{$province->city_name}}</p>
		</div>
	@empty

	@endforelse
@endsection
@section('script')
<script src="{{ url('/resources/assets/js/dol-theme.js')}}"></script>

@endsection