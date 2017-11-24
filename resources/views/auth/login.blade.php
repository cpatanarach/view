@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 space-30"></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Oper's Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="login" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" placeholder="บัญชีผู้ใช้" required autofocus>
                            </div>
                            
                        </div>

                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                            @if ($errors->has('login'))
                                <div class="col-md-6 col-md-offset-4 text-danger" style="padding: 0px;">
                                    <strong>{{ $errors->first('login') }}</strong>
                                </div>
                            @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ให้ฉันอยู่ในระบบตลอดไป
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-sign-in"></i>
                                    เข้าสู่ระบบ
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ฉันลืมรหัสผ่าน?
                                </a>
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
    <!-- Java Script-->
    <script type="text/javascript">
    </script>
@endsection