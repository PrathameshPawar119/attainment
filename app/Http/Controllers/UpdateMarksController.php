<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OralModel;
use App\Models\EndsemModel;
use App\Models\AssignmentModel;
use App\Models\ExperimentModel;
use App\Models\IaModel;
use App\Models\CriteriaModel;
use App\Models\CO_Oral_Endsem_Assign;
use App\Models\CO_IA;
use App\Models\CO_Expt;
use App\Models\ThresholdModel;

class UpdateMarksController extends Controller
{
    // public function __construct()
    // {
    //     parent::$criteiaTotalMarks;
    //     $this->criteiaTotalMarks = parent::$criteiaTotalMarks;
        
    // }

    public function updateOralMarks(Request $req){   

        $student = OralModel::join('student_details', 'student_details.id', 'oral.id')
                        ->where('student_id', '=', $req['id'])
                        ->where('user_key', '=', session()->get('user_id'))
                        ->update(['oral_marks'=>$req['value']]);
        if($student){
            echo "1";
        }
        else{
            echo "0";
        }
    }

    public function updateEndsemMarks(Request $req){
        $student = EndsemModel::join('student_details', 'student_details.id', 'endsem.id')
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->update(['endsem_marks'=>$req['value']]);
        if ($student) {
            echo "1";
        }
        else{
            echo "0";
        }
    }

    public function updateAssignmentMarks(Request $req){
        $student = AssignmentModel::join('student_details', 'student_details.id', 'assignments.id')
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->update([$req['column_name']=>$req['value']]);
        $assign_record = AssignmentModel::join('student_details', 'student_details.id', 'assignments.id')
                ->select('assignments.a1', 'assignments.a2')
                ->where("student_id", "=", $req['id'])
                ->where("user_key", "=", session()->get('user_id'))
                ->get();

        $a1_total = $assign_record[0]->a1;
        $a2_total = $assign_record[0]->a2;
        // $temp = $this->getCriteiaTotalMarks();
        $temp = getCriteiaTotalMarks();
        if($student){
            echo $a1_total."+".$a2_total."+".$temp->assign_total;
        }
        else{
            echo "0";
        }
    }
    
    public function updateIaMarks(Request $req){
        $student = IaModel::join('student_details', 'student_details.id', 'ia.id')
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->update([$req['column_name']=>$req['value']]);
        $ia_record = IaModel::join('student_details', 'student_details.id', 'ia.id')
                        ->select('student_details.student_id','ia.ia1', 'ia.ia2')
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->get();
        
        $ia1_total = $ia_record[0]->ia1;
        $ia2_total = $ia_record[0]->ia2;
        $temp = getCriteiaTotalMarks();

        if($student){
            echo $ia1_total."+".$ia2_total."+".$temp->ia1_total."+".$temp->ia2_total;
        }
        else{
            echo "0";
        }
    }
    
    public function updateExperimentMarks(Request $req){
        $student = ExperimentModel::join('student_details', 'student_details.id', 'experiments.id')
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->update([$req['column_name']=>$req['value']]);
        $ex = ExperimentModel::join('student_details', 'student_details.id', 'experiments.id')
                ->select('experiments.e1', 'experiments.e2', 'experiments.e3', 'experiments.e4', 'experiments.e5', 'experiments.e6', 'experiments.e7', 'experiments.e8', 'experiments.e9', 'experiments.e10', 'experiments.e11', 'experiments.e12')
                ->where("student_id", "=", $req['id'])
                ->where("user_key", "=", session()->get('user_id'))
                ->get();
        $temp = getCriteiaTotalMarks();

        if($student){
            echo $ex[0]->e1."+".$ex[0]->e2."+".$ex[0]->e3."+".$ex[0]->e4."+".$ex[0]->e5."+".$ex[0]->e6."+".$ex[0]->e7."+".$ex[0]->e8."+".$ex[0]->e9."+".$ex[0]->e10."+".$ex[0]->e11."+".$ex[0]->e12."+".$temp->exp_total;
        }
        else{
            echo "0";
        }
    }

    public function updateCriteriaMarks(Request $req){
        $student = CriteriaModel::join('signup_details', 'signup_details.user_id', 'criteria.user_id')
                        ->where("criteria.user_id", "=", session()->get('user_id'))
                        ->update([$req['column']=>$req['value']]);
        $ex = CriteriaModel::join('signup_details', 'signup_details.user_id', 'criteria.user_id')
                    ->select('criteria.assign_total', 'criteria.ia1_total', 'criteria.ia2_total', 'criteria.exp_total')
                    ->where("criteria.user_id", "=", session()->get('user_id'))
                    ->get();

        if($student){
            echo $ex[0]->assign_total."+".$ex[0]->ia1_total."+".$ex[0]->ia2_total."+".$ex[0]->exp_total;
        }
        else{
            echo "0";
        }
    }

    // function to update Cos for oral, endsem and assignments (as they have same input style)
    public function updateCoInputCheck1(Request $req){
        $co_tuple = CO_Oral_Endsem_Assign::join("signup_details", "signup_details.user_id", "co_oral_endsem_assign.user_id")
                        ->select($req['column'])
                        ->where("co_oral_endsem_assign.user_id", "=", session()->get('user_id'))
                        ->first();

        $previous_co_arr = json_decode($co_tuple[$req['column']]);
        $current_co = (int)$req['coInput'];
        
        // decide remove or add according to checked status
        if($req['status'] == "true"){
            array_unshift($previous_co_arr, $current_co);
        }
        else{
            foreach(array_keys($previous_co_arr, $current_co) as $key){
                unset($previous_co_arr[$key]);
            }
        }
        //  removing duplicates and sorting
        $tempArr = array_unique($previous_co_arr);
        sort($tempArr);
        $tempArr = json_encode($tempArr);

        $co_tuple_update = CO_Oral_Endsem_Assign::join("signup_details", "signup_details.user_id", "co_oral_endsem_assign.user_id")
                ->where("co_oral_endsem_assign.user_id", "=", session()->get('user_id'))
                ->update([$req['column']=>$tempArr]);
        if ($co_tuple_update) {
            echo true;
        }
        else{
            echo 0;
        }
    }

    // update cos for sheets - ia and expt
    public function updateCoInputCheck2(Request $req){
        if ($req['sheet'] == 'co_ia') {
        $co_tuple = CO_IA::join("signup_details", "signup_details.user_id", "co_ia.user_id")
                        ->select($req['coInput'])
                        ->where("co_ia.user_id", "=", session()->get('user_id'))
                        ->first();        }
        else if($req['sheet'] == 'co_expt'){
            $co_tuple = CO_Expt::join("signup_details", "signup_details.user_id", "co_expt.user_id")
                    ->select($req['coInput'])
                    ->where("co_expt.user_id", "=", session()->get('user_id'))
                    ->first();
        }

        $previous_co_arr = json_decode($co_tuple[$req['coInput']]);
        $current_co = $req['column'];

        // decide remove or add according to checked status
        if($req['status'] == "true"){
            array_unshift($previous_co_arr, $current_co);
        }
        else{
            foreach(array_keys($previous_co_arr, $current_co) as $key){
                unset($previous_co_arr[$key]);
            }
        }
        //  removing duplicates and sorting
        $tempArr = array_unique($previous_co_arr);
        sort($tempArr);
        $tempArr = json_encode($tempArr);
        if($req['sheet'] == 'co_ia'){
            $co_tuple_update = CO_IA::join("signup_details", "signup_details.user_id", "co_ia.user_id")
            ->where("co_ia.user_id", "=", session()->get('user_id'))
            ->update([$req['coInput']=>$tempArr]);
        }
        else if($req['sheet'] == 'co_expt'){
            $co_tuple_update = CO_Expt::join("signup_details", "signup_details.user_id", "co_expt.user_id")
            ->where("co_expt.user_id", "=", session()->get('user_id'))
            ->update([$req['coInput']=>$tempArr]);
        }
        if($co_tuple_update){
            echo $tempArr;
        }
        else{
            echo 0;
        }
    }

    public function updateThresholdCriteria(Request $req){
        $updateThMarks = ThresholdModel::where("user_id", "=", session()->get("user_id"))
                            ->update([$req['column']=>$req['value']]);
        if($updateThMarks){
            echo 1;
        }
        else{
            echo 0;
        }
        
    }


}
