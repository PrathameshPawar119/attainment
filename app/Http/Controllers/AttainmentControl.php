<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use App\Models\CO_IA;
use App\Models\CO_Oral_Endsem_Assign;
use App\Models\Co_Total_Ia;
use Illuminate\Http\Request;
use App\Models\ThresholdModel;
use App\Models\CriteriaModel;
use App\Models\EndsemModel;
use App\Models\OralModel;
use App\Models\StudentDetails;

class AttainmentControl extends Controller
{
    // this functions returns primary params 
    public function getAttainmentArrPartA($thresholdColumn, $criteriaColumn){
        $markCriteria = ThresholdModel::select($thresholdColumn)->where("user_id", "=", session()->get("user_id"))->first();
        $totalMarks = CriteriaModel::select($criteriaColumn)->where("user_id", "=", session()->get("user_id"))->first();
        $totalStudents = $this->totalNumStd();

        $criteriaFromTotalMarks = round((($totalMarks->$criteriaColumn)/100)*($markCriteria->$thresholdColumn));
        return array("markCriteria"=>$markCriteria, "totalMarks"=>$totalMarks,"totalStudents"=> $totalStudents,"criteriaFromTotalMarks"=> $criteriaFromTotalMarks);
    }

    public function getGroup3Cos($co_column_name){
        return CO_Oral_Endsem_Assign::select($co_column_name)->where("user_id", "=", session()->get("user_id"))->first();
    }

    public function IaQuestionsPerCo(){
        $output_arr = array();
        for ($i=1; $i <= 6; $i++) { 
            $Questions = CO_IA::select("CO$i")->where("user_id", "=", session()->get("user_id"))->first();
            array_push($output_arr, $Questions);
        }
        return $output_arr;
    }

    function arrayBank($arr){

    }

    public function IaTotalPerCO($arr){
        $output_arr = array();
        for($i=0; $i<6; $i++){
            $j = $i+1;
            $co_arr = json_decode($arr[$i]["CO$j"]);
            $update_co_column = Co_Total_Ia::join("student_details", "student_details.id", "co_total_ia.id")
                                    ->join("ia", "ia.id", "co_total_ia.id")
                                    ->select("co_total_ia_id", (current($co_arr) ?current($co_arr) :'ia1') , (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'))
                                    ->where("user_key", "=", session()->get("user_id"))
                                    ->where("student_details.deleted_at", "=", null)->get();
            array_push($output_arr, $update_co_column);
        }
        return $output_arr;

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
        
        $oral_cos = $this->getGroup3Cos("oral_co");
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
        
        $endsem_cos = $this->getGroup3Cos("endsem_co");
        $attain_level = $this->getAttainmentLevel($perStdMoreThanCriteria);

        $resArr = array($params["markCriteria"]->endsem, $params["totalMarks"]->endsem_total, $params["criteriaFromTotalMarks"], $numStdMoreThanCriteria, $perStdMoreThanCriteria, $endsem_cos->endsem_co, $attain_level);
        return view('attainment.endsem', compact('resArr'));
    }

    public function AssignAttainment(Request $req){
        $params = $this->getAttainmentArrPartA('assigns', 'assign_total');
        $numStdMoreThanCriteriaA1 = AssignmentModel::join("student_details", "student_details.id", "assignments.id")
                                                ->where("user_key", "=", session()->get("user_id"))
                                                ->where("deleted_at", "=", null)
                                                ->where("a1", ">", $params["criteriaFromTotalMarks"])
                                                ->select("student_id")
                                                ->distinct()->count(); 
        $numStdMoreThanCriteriaA2 = AssignmentModel::join("student_details", "student_details.id", "assignments.id")
                                                ->where("user_key", "=", session()->get("user_id"))
                                                ->where("deleted_at", "=", null)
                                                ->where("a2", ">", $params["criteriaFromTotalMarks"])
                                                ->select("student_id")
                                                ->distinct()->count(); 
        $perStdMoreThanCriteriaA1 = round(($numStdMoreThanCriteriaA1/$params["totalStudents"])*100);
        $perStdMoreThanCriteriaA2 = round(($numStdMoreThanCriteriaA2/$params["totalStudents"])*100);

        $assign1_cos = $this->getGroup3Cos("assign1_co");
        $assign2_cos = $this->getGroup3Cos("assign2_co");

        $attain_level_A1 = $this->getAttainmentLevel($perStdMoreThanCriteriaA1);
        $attain_level_A2 = $this->getAttainmentLevel($perStdMoreThanCriteriaA2);

        $assign1_arr = array($numStdMoreThanCriteriaA1, $perStdMoreThanCriteriaA1, $assign1_cos, $attain_level_A1);
        $assign2_arr = array($numStdMoreThanCriteriaA2, $perStdMoreThanCriteriaA2, $assign2_cos, $attain_level_A2);

        return view("attainment.assignment", compact('params', 'assign1_arr', 'assign2_arr'));
    }

    public function IaAttainment(){
        $params_Ia1 = $this->getAttainmentArrPartA('ia', 'ia1_total');
        $params_Ia2 = $this->getAttainmentArrPartA('ia', 'ia2_total');
        // I got CriteriaMarks, IA1TotalMarks, Ia2TotalMarks, totalStudents & criteriaFromTotalMarks fro both IAs

        $cos = $this->IaQuestionsPerCo();
        $updateCOs = $this->IaTotalPerCO($cos);


        return view('attainment.ia', compact('updateCOs'));

    }
}
