<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OralModel;
use App\Models\EndsemModel;

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
}
