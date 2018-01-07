@extends('layouts.app_no_bar')
@section('meta')
    <meta http-equiv="refresh" content="180"/>
@endsection
@section('content')
<div class="container">
    <div class="col-md-12 space-30"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h5 class="text-primary">สำนักงานที่ดิน@if($city->city_id != 1)จังหวัด@endif{{$city->city_name}}</h5>

        </div>
        
    </div>
</div>
@endsection
@section('script')
    <script src="{{url('/resources/assets/js/main_mobile.js')}}"></script>
    <script type="text/javascript">

    </script>
@endsection