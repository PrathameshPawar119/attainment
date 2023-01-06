<?php

// ALTER TABLE `student_details` AUTO_INCREMENT = 1;
// Very Userful Query to restart autoincrement from 1 again!!!! (assumed all rows deleted)

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

if (!function_exists('getCriteiaTotalMarks')) {
    function getCriteiaTotalMarks(){
        $ex = CriteriaModel::join('signup_details', 'signup_details.user_id', 'criteria.user_id')
            ->select('criteria.user_id', 'criteria.oral_total', 'criteria.endsem_total', 'criteria.assign_total', 'criteria.ia1_total', 'criteria.ia2_total', 'criteria.exp_total')
            ->where("criteria.user_id", "=", session()->get('user_id'))
            ->first();

        return $ex;
    }
}
