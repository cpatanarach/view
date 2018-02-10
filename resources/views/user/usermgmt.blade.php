@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 space-30"></div>
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="fa fa-check"></span> {{Session::get('success')}}
                </div>
            @endif
            <table class="table table-hover">
                <tr>
                    <td colspan="12" class="text-center info">
                        การจัดการผู้ใช้งาน
                    </td>
                </tr>
                @forelse($users as $user)
                    <tr>
                        <td colspan="2">[{{$user->id}}] {{$user->created_at}}</td>
                        <td colspan="2">{{$user->email}}</td>
                        <td colspan="3">{{$user->prefix}}{{$user->firstname}}&nbsp&nbsp{{$user->lastname}}</td>
                        <td colspan="2">
                            <form forUser="{{$user->id}}"  class="form-inline" action="{{url('/usermanagement/update')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="ref" value="{{$user->id}}">
                                <select class="form-control" name="ref2" onchange="submitUser({{$user->id}});">
                                    <option value="0" @if($user->level == 0)selected @endif>GUEST</option>
                                    <option value="1" @if($user->level == 1)selected @endif>USER</option>
                                    <option value="2" @if($user->level == 2)selected @endif>SENIOR</option>
                                    <option value="4" @if($user->level == 4)selected @endif>SUPERUSER</option>
                                    <option value="6" @if($user->level == 6)selected @endif>ADMIN</option>
                                </select>
                            </form>
                        </td>
                        <td colspan="1">
                            <form forUserDestroy="{{$user->id}}"  class="form-inline" action="{{url('/usermanagement/destroy')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="ref" value="{{$user->id}}">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$user->id}}"><span class="fa fa-ban"></span> ลบผู้ใช้งาน</button>

                                  <!-- Modal -->
                                  <div class="modal fade" id="myModal{{$user->id}}" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Woops!</h4>
                                        </div>
                                        <div class="modal-body">
                                          <p>คุณต้องการลบข้อมูล {{$user->email}} ออกจากระบบหรือไม่</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="destroyUser({{$user->id}});">ลบผู้ใช้งาน</button>
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
                        <td colspan="12" class="text-center text-warning">
                            ผู้ใช้งานยังไม่ลงทะเบียน
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Java Script-->
    <script type="text/javascript">
        function submitUser(id){
            $('form[forUser='+ id + ']').submit();
            getPageLoading();
        }
        function destroyUser(id){
            $('form[forUserDestroy='+ id + ']').submit();
            getPageLoading();
        }
        function getPageLoading(){
            $('#pageLoading').css('display','block');
        }
    </script>
@endsection