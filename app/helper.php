<?php

// ALTER TABLE `student_details` AUTO_INCREMENT = 1;
// Very Userful Query to restart autoincrement from 1 again!!!! (assumed all rows deleted)

// php -S 127.0.0.1:8000 -t public/
// use this command wheneer artisan serve keeps loading

use App\Models\CriteriaModel;

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

