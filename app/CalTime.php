<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class CalTime extends Model
{
	protected $thaiMonth = [
    	'Jan' => 'มกราคม',
    	'Feb' => 'กุมภาพันธ์',
    	'Mar' => 'มีนาคม',
    	'Apr' => 'เมษายน',
    	'May' => 'พฤษภาคม',
    	'Jun' => 'มิถุนายน',
    	'Jul' => 'กรกฎาคม',
    	'Aug' => 'สิงหาคม',
    	'Sep' => 'กันยายน',
    	'Oct' => 'ตุลาคม',
    	'Nov' => 'พฤศจิกายน',
    	'Dec' => 'ธันวาคม',
    ];
    protected $thaiDate = [
    	'Sun' => 'อาทิตย์',
    	'Mon' => 'จันทร์',
    	'Tue' => 'อังคาร',
    	'Wed' => 'พุธ',
    	'Thu' => 'พฤหัสบดี',
    	'Fri' => 'ศุกร์',
    	'Sat' => 'เสาร์',
    ];
    protected function timeDown($timeStart, $dateStart){
		$dFirst = new DateTime($dateStart.$timeStart);
		$timeNow = new DateTime();
		$bdYear = $timeNow->format('Y')+543;
		$dSecond = new DateTime($bdYear.'-'.$timeNow->format('m-d H:i:s'));
		$dOut = date_diff($dFirst,$dSecond);
		if((int)$dOut->format('%a') == 0 && (int)$dOut->format('%H') != 0){
			return $dOut->format('%h ชั่วโมง %i นาที');
		}else if((int)$dOut->format('%a') == 0 && (int)$dOut->format('%H') == 0){
			return $dOut->format('%i นาที');
		}else if((int)$dOut->format('%a') == 0 && (int)$dOut->format('%H') == 0 && $dOut->format('%i') == 0){
			return $dOut->format('%s วินาที');
		}else{
    		return $dOut->format('%a วัน %h ชั่วโมง %i นาที');
		}
    }
    protected function getBasicFormatTimeDown($timeStart, $dateStart){
        $dFirst = new DateTime($dateStart.$timeStart);
        $timeNow = new DateTime();
        $bdYear = $timeNow->format('Y')+543;
        $dSecond = new DateTime($bdYear.'-'.$timeNow->format('m-d H:i:s'));
        //for test Program has been down $dSecond->modify("+61 minutes");        
        $dOut = date_diff($dFirst,$dSecond);
        return $dOut;
    }
    protected function widthImage($timeStart, $dateStart){
    	$dFirst = new DateTime($dateStart.$timeStart);
		$timeNow = new DateTime();
		$bdYear = $timeNow->format('Y')+543;
		$dSecond = new DateTime($bdYear.'-'.$timeNow->format('m-d H:i:s'));
		$dOut = date_diff($dFirst,$dSecond);
		if($dOut->format('%a') >= 1 || $dOut->format('%h') >= 1){
			return 'width: 32px;';
		}else{
			$width = ($dOut->format('%i')/60)*32;
			return 'width:'.$width.'px;';
		}
    }
    protected function getTimeNow(){
    	$timeNow = new DateTime();
    	return 'วัน'.$this->thaiDate[$timeNow->format('D')].'ที่ '. $timeNow->format('j').' '.$this->thaiMonth[$timeNow->format('M')] .' '.($timeNow->format('Y')+543);
    }
}
