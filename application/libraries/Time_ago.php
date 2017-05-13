<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Time_ago {

    // CLASS FOR CONVERTING TIME TO AGO

    function convert_datetime($str) {
        list($date, $time) = explode(' ', $str);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minute, $second) = explode(':', $time);
        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
        return $timestamp;
    }

    function make_ago($timestamp) {
        $difference = time() - $timestamp;
        $periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        for ($j = 0; $difference >= $lengths[$j]; $j++)
            $difference /= $lengths[$j];
        $difference = round($difference);
        //if($difference != 1) $periods[$j].= "s";
        $text = "$difference $periods[$j] ago";
        if ($periods[$j] == "sec") {
            $text = "just now";
        }
        return $text;
    }

    function convert_time_ago($time) {
        //time ago
        $ts = $time;
        $convertTime = ($this->convert_datetime($ts));
        return($this->make_ago($convertTime));
    }

}

/* End of file Time_ago.php */