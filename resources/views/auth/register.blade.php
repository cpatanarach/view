@extends('layouts.app3')
@section('meta')
    <!-- META -->
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 space-30">
            <div class="panel panel-default">
                <div class="panel-heading">Oper's Register</div>
                <div class="panel-body">
                    <form type="register" class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">รหัสบัตรประจำตัว 13 หลัก</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control bfh-phone" name="username" value="{{ old('username') }}" data-format="ddddddddddddd" placeholder="เลขประจำตัวประชาชน 13 หลัก" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('prefix') ? ' has-error' : '' }}">
                            <label for="prefix" class="col-md-4 control-label">คำนำหน้า</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="prefix" value="นาย" @if(old('prefix') == 'นาย') checked @endif >นาย</label>
                                <label class="radio-inline"><input type="radio" name="prefix" value="นาง" @if(old('prefix') == 'นาง') checked @endif >นาง</label>
                                <label class="radio-inline"><input type="radio" name="prefix" value="นางสาว" @if(old('prefix') == 'นางสาว') checked @endif >นางสาว</label>
                                <label class="radio-inline"><input type="radio" name="prefix" value="0" @if(old('prefix') == '0') checked @endif >อื่นๆ</label>
                            </div>
                            <div class="col-md-3 col-md-offset-4" style="padding-top: 5px;">
                                <input id="prefix-other" type="text" class="form-control" name="prefix-other" value="{{old('prefix-other')}}" placeholder="อื่นๆ..." @if(old('prefix') != '0') readonly="true" @endif required>

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">ชื่อ</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="ชื่อ" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">สกุล</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="นามสกุล" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">โทรศัทพ์</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control bfh-phone" data-format="dd dddd dddd" name="phone" value="{{ old('phone') }}" placeholder="หมายเลขโทรศัพท์" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone2') ? ' has-error' : '' }}">
                            <label for="phone2" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="phone2" type="text" class="form-control bfh-phone" data-format="dd dddd dddd" name="phone2" value="{{ old('phone2') }}" placeholder="หมายเลขสำรอง" required>

                                @if ($errors->has('phone2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button id="register" type="button" class="btn btn-primary">
                                    <i class="fa fa-user-circle-o"></i>
                                    ลงทะเบียน
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
    <!-- SCRIPT -->
     <script src="{{ url('/resources/assets/formhelper/bootstrap-formhelpers-phone.js') }}"></script>
     <script type="text/javascript">
        //onRegisterClick()
         $('#register').click(function(){
            var phone2 = $('input[name=phone2]').val();
            if(phone2.length < 12){
                $('input[name=phone2]').val('-');
            }
            $('form[type=register]').delay(300).submit();
         });
         //radio input helper
         $('input[name=prefix]').change(function(){
            var prefix = $(this).val();
            if(prefix == 0){
                $('#prefix-other').removeAttr('readonly').focus();
            }else{
                $('#prefix-other').val('').attr('readonly','true');
            }
         });
     </script>
@endsection
