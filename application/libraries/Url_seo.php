<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Url_seo {

    function slug($string, $spaceRepl = "-") {
// Replace "&" char with "and"
        $string = str_replace("&", "and", $string);
// Delete any chars but letters, numbers, spaces and _, -
        $string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);
// Optional: Make the string lowercase
        $string = strtolower($string);
// Optional: Delete double spaces
        $string = preg_replace("/[ ]+/", " ", $string);
// Replace spaces with replacement
        $string = str_replace(" ", $spaceRepl, $string);
        return $string;
    }

    function khong_dau($str) {
        if (!$str){ return false;}
           
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|A|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'b' => 'B', 'c' => 'C', 'd' => 'd|D|đ|Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'f' => 'F', 'g' => 'G', 'h' => 'H',
            'i' => 'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
            'j' => 'J', 'k' => 'K', 'l' => 'L', 'm' => 'M', 'n' => 'N',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Õ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'p' => 'P', 'q' => 'Q', 'r' => 'R', 's' => 'S', 't' => 'T',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'v' => 'V', 'w' => 'W', 'x' => 'X',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            'z' => 'Z',
        );
        foreach ($unicode as $nonUnicode => $uni)
        {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
            
        return $str;
    }

}