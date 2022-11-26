<?php


if(!function_exists('test_print')){
    function test_print($data){
       echo "<pre>";
       print_r($data);
       echo "</pre>";
   }
}

if(!function_exists('get_formatted_date')){
    function get_formatted_date($date, $format){
        $formattedDate = date($format, strtotime($date));
        return $formattedDate;
    }
}

