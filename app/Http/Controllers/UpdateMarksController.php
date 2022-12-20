<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OralModel;
use App\Models\EndsemModel;
use App\Models\AssignmentModel;
use App\Models\ExperimentModel;
use App\Models\IaModel;

class UpdateMarksController extends Controller
{
    public function updateOralMarks(Request $req){   

        $student = OralModel::join('student_details', 'student_details.id', 'oral.id')
                        ->select('student_id', 'oral_marks')
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
                        ->select('student_id', 'endsem_marks')
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
                        ->select('student_id', $req['column_name'])
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->update([$req['column_name']=>$req['value']]);
        $assign_record = AssignmentModel::join('student_details', 'student_details.id', 'assignments.id')
                ->select('student_details.student_id','assignments.a1', 'assignments.a2')
                ->where("student_id", "=", $req['id'])
                ->where("user_key", "=", session()->get('user_id'))
                ->get();

        $a1_total = $assign_record[0]->a1;
        $a2_total = $assign_record[0]->a2;
        if($student){
            echo $a1_total."+".$a2_total;
        }
        else{
            echo "0";
        }
    }
    
    public function updateIaMarks(Request $req){
        $student = IaModel::join('student_details', 'student_details.id', 'ia.id')
                        ->select('student_id', $req['column_name'])
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
        if($student){
            echo $ia1_total."+".$ia2_total;
        }
        else{
            echo "0";
        }
    }
    
    public function updateExperimentMarks(Request $req){
        $student = ExperimentModel::join('student_details', 'student_details.id', 'experiments.id')
                        ->select('student_id', $req['column_name'])
                        ->where("student_id", "=", $req['id'])
                        ->where("user_key", "=", session()->get('user_id'))
                        ->update([$req['column_name']=>$req['value']]);
        $ex = ExperimentModel::join('student_details', 'student_details.id', 'experiments.id')
                ->select('student_details.student_id','experiments.e1', 'experiments.e2', 'experiments.e3', 'experiments.e4', 'experiments.e5', 'experiments.e6', 'experiments.e7', 'experiments.e8', 'experiments.e9', 'experiments.e10', 'experiments.e11', 'experiments.e12')
                ->where("student_id", "=", $req['id'])
                ->where("user_key", "=", session()->get('user_id'))
                ->get();

        if($student){
            echo $ex[0]->e1."+".$ex[0]->e2."+".$ex[0]->e3."+".$ex[0]->e4."+".$ex[0]->e5."+".$ex[0]->e6."+".$ex[0]->e7."+".$ex[0]->e8."+".$ex[0]->e9."+".$ex[0]->e10."+".$ex[0]->e11."+".$ex[0]->e12;
        }
        else{
            echo "0";
        }
    }
}
