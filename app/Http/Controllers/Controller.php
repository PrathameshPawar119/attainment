<?php

namespace App\Http\Controllers;

use App\Models\CriteriaModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\StudentDetails;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAttainmentLevel($percent, $totalMarks){
        if ($percent == 100 && $totalMarks == 0) {
            return 0;
        }
        if($percent >= 60)
        {
            return 3; //attainment level 3
        }
        else if($percent >= 50 && $percent < 60){
            return 2; //attainment level 2
        }
        return 1;  //attainment level 1
    }

    // function provides total number of students for live user 
    public function totalNumStd(){
         $totalNumStd = StudentDetails::where("user_key", "=", session()->get("user_id"))
                                                ->where("deleted_at", "=", null)
                                                ->select("student_id")
                                                ->distinct()->count();
        if($totalNumStd){
            return $totalNumStd;
        }
        return 0;
    }

    //function to put login details in session to keep user logged in
    public function PutUserSession($username, $email, $user_id){
        session()->put("username", $username);
        session()->put("user_email", $email);
        session()->put("user_id", $user_id);
    }

    public function getCriteiaTotalMarks($CriteriaColumn){
        $ex = CriteriaModel::join('signup_details', 'signup_details.user_id', 'criteria.user_id')
            ->select("criteria.$CriteriaColumn")
            ->where("criteria.user_id", "=", session()->get('user_id'))
            ->first();
        return $ex;
    }
}
