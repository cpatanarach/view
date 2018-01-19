@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12 text-center">
    		<div class="space-30"></div>
	        <h1 class="font-raleway"><span class="fa fa-warning text-danger"></span> Woops</h1>
	        <h4 class="font-raleway">Permission has been blocked. Please contact system <a href="{{url('/contact')}}" class="no-decoration"> administrator.</a></h4>
	        <a href="{{url('/home')}}" class="btn btn-warning"><i class="fa fa-home"></i> Go back to Home</a>
    	</div>
    </div>
</div>
@endsection
