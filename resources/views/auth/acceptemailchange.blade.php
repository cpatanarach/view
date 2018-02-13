@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="space-30"></div>
    <div class="space-30"></div>
        <div class="alert alert-success alert-dismissable">
            <a href="{{url('/home')}}" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="fa fa-check"></span> การยืนยันอีเมล สมบูรณ์
        </div>
    <div class="space-30"></div>
    <div class="space-30"></div>
</div>
@endsection
@section('script')
    <!-- Java Script-->
    <script type="text/javascript">
    </script>
@endsection