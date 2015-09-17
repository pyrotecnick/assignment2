<?php

//namespace view;

class DateTimeView {


	public function show() {
            
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
                $timeString .= 'th of ';
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