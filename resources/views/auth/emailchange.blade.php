@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 space-30">
            <div class="panel panel-default">
                <div class="panel-heading">Change Email</div>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <span class="fa fa-check"></span> {{ session('success') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{url('/sendRequestEmailChange')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" onclick="getPageLoading();">
                                    <span class="fa fa-send"></span>
                                    ส่งลิงก์ยืนยัน
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function getPageLoading(){
            $('#pageLoading').css('display','block');
        }
    </script>
@endsection