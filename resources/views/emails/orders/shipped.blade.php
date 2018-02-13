@component('mail::message')
# เรียน คุณ{{$name}}

นี่คือขั้นตอนการยืนยันการใช้งานอีเมล  เพื่อรับข่าวสารจากฝ่ายปฏิบัติการคอมพิวเตอร์  กรุณาคลิก "ยืนยัน" เพื่อดำเนินการต่อ

@component('mail::button', ['url' => url('/email/accept').'?ref='.$mailCrypt , 'color' => 'green'])
ยืนยัน
@endcomponent
หากท่านไม่สามารถคลิก "ยืนยัน" ให้ทำการคัดลอก <a target="_blank" href="{{url('/email/accept')}}/{{$mailCrypt}}">{{url('/email/accept')}}?ref={{$mailCrypt}}</a> ไปวางยังเว็บเบราว์เซอร์ของท่าน

ขอแสดงความนับถือ <br>
ฝ่ายปฏิบัติการคอมพิวเตอร์ สำนักเทคโนโลยีสารสนเทศ กรมที่ดิน<br>
@endcomponent
