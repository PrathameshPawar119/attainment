<?php

namespace App\Http\Controllers;

use App\Models\CO_Oral_Endsem_Assign;
use Illuminate\Http\Request;
use App\Models\ThresholdModel;
use App\Models\CriteriaModel;
use App\Models\EndsemModel;
use App\Models\OralModel;
use App\Models\StudentDetails;

class AttainmentControl extends Controller
{
    public function getAttainmentArrPartA($thresholdColumn, $criteriaColumn){
        $markCriteria = ThresholdModel::select($thresholdColumn)->where("user_id", "=", session()->get("user_id"))->first();
        $totalMarks = CriteriaModel::select($criteriaColumn)->where("user_id", "=", session()->get("user_id"))->first();
        $totalStudents = $this->totalNumStd();

        $criteriaFromTotalMarks = round((($totalMarks->$criteriaColumn)/100)*($markCriteria->$thresholdColumn));
        return array("markCriteria"=>$markCriteria, "totalMarks"=>$totalMarks,"totalStudents"=> $totalStudents,"criteriaFromTotalMarks"=> $criteriaFromTotalMarks);
    }

    public function OralAttainment(Request $req){
        $params = $this->getAttainmentArrPartA('oral', 'oral_total');
        $numStdMoreThanCriteria = OralModel::join("student_details", "student_details.id", "oral.id")
                                    ->where("user_key", "=", session()->get("user_id"))
                                    ->where("deleted_at", "=", null)
                                    ->where("oral_marks", ">", $params["criteriaFromTotalMarks"])
                                    ->select("student_id")
                                    ->distinct()->count();
        
        $perStdMoreThanCriteria = round(($numStdMoreThanCriteria/$params["totalStudents"])*100);
        
        $oral_cos = CO_Oral_Endsem_Assign::select('oral_co')->where("user_id", "=", session()->get("user_id"))->first();
        $attain_level = $this->getAttainmentLevel($perStdMoreThanCriteria);

        $resArr = array($params["markCriteria"]->oral, $params["totalMarks"]->oral_total, $params["criteriaFromTotalMarks"], $numStdMoreThanCriteria, $perStdMoreThanCriteria,$oral_cos->oral_co, $attain_level);
        return view('attainment.oral', compact('resArr'));
    }

    public function EndsemAttainment(Request $req){
        $params = $this->getAttainmentArrPartA('endsem', 'endsem_total');
        $numStdMoreThanCriteria = EndsemModel::join("student_details", "student_details.id", "endsem.id")
                                    ->where("user_key", "=", session()->get("user_id"))
                                    ->where("deleted_at", "=", null)
                                    ->where("endsem_marks", ">", $params["criteriaFromTotalMarks"])
                                    ->select("student_id")
                                    ->distinct()->count();
        
        $perStdMoreThanCriteria = round(($numStdMoreThanCriteria/$params["totalStudents"])*100);
        
        $endsem_cos = CO_Oral_Endsem_Assign::select('endsem_co')->where("user_id", "=", session()->get("user_id"))->first();
        $attain_level = $this->getAttainmentLevel($perStdMoreThanCriteria);

        $resArr = array($params["markCriteria"]->endsem, $params["totalMarks"]->endsem_total, $params["criteriaFromTotalMarks"], $numStdMoreThanCriteria, $perStdMoreThanCriteria, $endsem_cos->endsem_co, $attain_level);
        return view('attainment.endsem', compact('resArr'));
    }
}
