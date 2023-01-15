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

class AttainmentControl extends Controller
{
    // this functions returns primary params 
    public function getAttainmentArrPartA($thresholdColumn, $criteriaColumn){
        $markCriteria = ThresholdModel::select($thresholdColumn)->where("user_id", "=", session()->get("user_id"))->first();
        $totalMarks = CriteriaModel::select($criteriaColumn)->where("user_id", "=", session()->get("user_id"))->first();
        $totalStudents = $this->totalNumStd();

        $criteriaFromTotalMarks = round((($totalMarks->$criteriaColumn)/100)*($markCriteria->$thresholdColumn), 2);
        return array("markCriteria"=>$markCriteria, "totalMarks"=>$totalMarks,"totalStudents"=> $totalStudents,"criteriaFromTotalMarks"=> $criteriaFromTotalMarks);
    }

    // this function returns primary params when total marks are ready
    public function getAttainmentArrPartB($thresholdColumn, $totalMark){
        $markCriteria = ThresholdModel::select($thresholdColumn)->where("user_id", "=", session()->get('user_id'))->first();
        $totalStudents = $this->totalNumStd();
        $criteriaFromTotalMarks = round((($totalMark)/100)*($markCriteria->$thresholdColumn), 2);
        return array("markCriteria"=>$markCriteria, "totalMarks"=>$totalMark,"totalStudents"=> $totalStudents,"criteriaFromTotalMarks"=> $criteriaFromTotalMarks);
    }

    // public function get
    public function getGroup3Cos($co_column_name){
        return CO_Oral_Endsem_Assign::select($co_column_name)->where("user_id", "=", session()->get("user_id"))->first();
    }

// IA questions in each co
    public function IaQuestionsPerCo(){
        $output_arr = array();
        for ($i=1; $i <= 6; $i++) { 
            $Questions = CO_IA::select("CO$i")->where("user_id", "=", session()->get("user_id"))->first();
            array_push($output_arr, $Questions);
        }
        return $output_arr;
    }

// 2 functions for IA total attainment
    public function IaTotalPerCO($arr){
        // $arr must contain questions per co in ia
        $output_arr = array();
        for($i=0; $i<6; $i++){
            $j = $i+1;
            $co_arr = json_decode($arr[$i]["CO$j"]);
            $update_co_column = Co_Total_Ia::join("student_details", "student_details.id", "co_total_ia.id")
                                    ->join("ia", "ia.id", "co_total_ia.id")
                                    ->select("co_total_ia_id", (current($co_arr) ?current($co_arr) :'ia1') , (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'), (next($co_arr)?current($co_arr):'ia1'))
                                    ->where("user_key", "=", session()->get("user_id"))
                                    ->where("student_details.deleted_at", "=", null)->get();
            array_push($output_arr, $update_co_column);
        }
        return $output_arr;
    }

    // Function to calculate Total OutOf marks for each Co in IA and EXPT
    public function OutOfMarksPerCo($arr){
        // $arr must contain questions per co in ia
        $output_arr = array();
        $fake_arr = array();
        for($i=0; $i<6; $i++){
            $j = $i+1;
            $co_arr = json_decode($arr[$i]["CO$j"]);
            $co_arr2 = array();
            foreach($co_arr as $q){
                // converting '1a1q1' to 'ia1_q1'
                $temp = substr_replace($q, "_", 3, 0);
                array_push($co_arr2, $temp);
            }
            // Fetching required Question outof marks
            $co_arr = $co_arr2;
            $outOf = CriteriaModel::join("signup_details", "signup_details.user_id", "criteria.user_id")
                            ->select((current($co_arr) ? current($co_arr) :'ia1_total') , (next($co_arr)?current($co_arr):'ia1_total'), (next($co_arr)?current($co_arr):'ia1_total'), (next($co_arr)?current($co_arr):'ia1_total'), (next($co_arr)?current($co_arr):'ia1_total'), (next($co_arr)?current($co_arr):'ia1_total'))
                            ->where("signup_details.user_id", "=", session()->get("user_id"))->get();
            array_push($output_arr, $outOf[0]);
        }

        //Adding question outof marks and pushing in final arr
        foreach ($output_arr as $QsPerCo) {
            $co_total = 0;
            foreach (json_decode($QsPerCo) as $value) {
                $co_total = $co_total +$value;
            }
            $co_total = $co_total - $QsPerCo->ia1_total; // remove dummy column
            array_push($fake_arr, $co_total);
        }

        $output_arr = $fake_arr;
        return $output_arr;
    }

    public function UpdateIaCoTotalTable($updateCOs, $cos){
        foreach ($updateCOs as $key=>$QuestionsPerCo) {
            // 6 COS Questions
            $current_co = "CO".$key+1;
            // current questions in that co to traverse object directly
            $current_qs_arr = json_decode($cos[$key][$current_co]);
            foreach ($QuestionsPerCo as $value1) {
                $a = (json_decode($value1)); // set of marks for each student
                $ia_mark_sum = 0;
                foreach ($current_qs_arr as $key => $value) {
                    $ia_mark_sum = $ia_mark_sum + $a->$value;
                }
                $update_co_column_query = Co_Total_Ia::where("co_total_ia_id", "=", $a->co_total_ia_id)
                                            ->update([$current_co=>$ia_mark_sum]);
            }
        }
    }


    public function OralAttainment(Request $req){
        $params = $this->getAttainmentArrPartA('oral', 'oral_total');
        $numStdMoreThanCriteria = OralModel::join("student_details", "student_details.id", "oral.id")
                                    ->where("user_key", "=", session()->get("user_id"))
                                    ->where("deleted_at", "=", null)
                                    ->where("oral_marks", ">=", $params["criteriaFromTotalMarks"])
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
                                    ->where("endsem_mark", ">=", $params["criteriaFromTotalMarks"])
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
                                                ->where("a1", ">=", $params["criteriaFromTotalMarks"])
                                                ->select("student_id")
                                                ->distinct()->count(); 
        $numStdMoreThanCriteriaA2 = AssignmentModel::join("student_details", "student_details.id", "assignments.id")
                                                ->where("user_key", "=", session()->get("user_id"))
                                                ->where("deleted_at", "=", null)
                                                ->where("a2", ">=", $params["criteriaFromTotalMarks"])
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

    public function GetCoTotalIaTable(){
        // Made this saperate function, so that it can be called by ajax 
        // so for paginate, no need to calculate and update co_total_ia again and again
        // https://stackoverflow.com/questions/36279716/how-to-set-pagination-in-laravel-without-refreshing-the-whole-page
        $co_total_table_details = Co_Total_Ia::join("student_details", "student_details.id", "co_total_ia.id")
                            ->select("student_details.roll_no","student_details.student_id","student_details.name", "student_details.div", "co_total_ia.CO1", "co_total_ia.CO2", "co_total_ia.CO3", "co_total_ia.CO4", "co_total_ia.CO5", "co_total_ia.CO6" )
                            ->where("user_key", "=", session()->get('user_id'))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')->paginate(10);
        return $co_total_table_details;
    }

    // Attainment Level for each co here
    public function GetAttainLevelsForIaCo($column, $params){
        $numStdMoreThanCriteria = Co_Total_Ia::join("student_details", "student_details.id", "co_total_ia.id")
                                    ->where("user_key", "=", session()->get("user_id"))
                                    ->where("deleted_at", "=", null)
                                    ->where("$column", ">=", $params['criteriaFromTotalMarks'])
                                    ->select("student_id")
                                    ->distinct()->count();
        $perStdMoreThanCriteria = round((($numStdMoreThanCriteria/$params['totalStudents'])*100), 2);
        $attain_level = $this->getAttainmentLevel($perStdMoreThanCriteria);

        return array("numStdMoreThanCriteria"=>$numStdMoreThanCriteria, "perStdMoreThanCriteria"=>$perStdMoreThanCriteria, "attain_level"=>$attain_level);
    }


    public function IaAttainment(){
    //Table 1--> for showing total marks per co
        //get cos --> returns array of questions ask in each co, varies per user
        $cos = $this->IaQuestionsPerCo();
        // get iaQs marks for particular student --> returns nested array-object ending with onject cntaining, co_total_ia_id, and marks
        $updateCOs = $this->IaTotalPerCO($cos);
        // update co_table_isa according to cos and updateCOs data of students marks
        $finallyUpdateCOTableIA = $this->UpdateIaCoTotalTable($updateCOs, $cos);

        // Function to get co_total_ia table
        $co_total_table_details = $this->GetCoTotalIaTable();

    // Table 2--> for showing attainment table
        // Outof Marks per Co
        $outof_per_co = $this->OutOfMarksPerCo($cos);

        $all_co_params = array();
        $finalCoAttainments = array();
        for ($i=0; $i < 6; $i++) { 
            $j = $i+1;
            $co_param = $this->getAttainmentArrPartB('ia', $outof_per_co[$i]);
            array_push($all_co_params, $co_param);        
            $co_attain = $this->GetAttainLevelsForIaCo("CO$j", $co_param);
            array_push($finalCoAttainments, $co_attain);    
        }

        return view('attainment.ia', compact('co_total_table_details', 'outof_per_co', 'all_co_params', 'finalCoAttainments'));

    }
}