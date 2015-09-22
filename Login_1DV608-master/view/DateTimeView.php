<?php

//namespace view;

class DateTimeView {


	public function show() {
                date_default_timezone_set('Europe/Copenhagen');
            
                $data = getdate();
                $weekday = $data['weekday'];
                $mday = $data['mday'];
                $month = $data['month'];
                $year = $data['year'];
                $hours = $data['hours'];
                $minutes = $data['minutes'];
                $seconds = $data['seconds'];
                

		$timeString = $weekday;
                $timeString .= ', the ';
                $timeString .= $mday;
                if($mday == 1 || $mday == 21 || $mday == 31){
                    $timeString .= 'st of ';
                } else if($mday == 2 || $mday == 22){
                    $timeString .= 'nd of ';
                } else if($mday == 3 || $mday == 23){
                    $timeString .= 'rd of ';
                } else {
                    $timeString .= 'th of ';
                }
                $timeString .= $month;
                $timeString .=  ' ';
                $timeString .= $year;
                $timeString .=  ', The time is ';
                $timeString .= $hours;
                $timeString .= ':';
                $timeString .= $minutes; 
                $timeString .= ':';
                $timeString .= $seconds;

		return '<p>' . $timeString . '</p>';
	}
}