<?php

namespace App\Http\Controllers\api\Charts;

use App\Http\Controllers\Controller;
use App\Models\AssignmentModel;
use Illuminate\Http\Request;

use App\Models\FinalAttainment;
use App\Models\CriteriaModel;
use App\Models\EndsemModel;
use App\Models\IaModel;
use App\Models\OralModel;

use function Ramsey\Uuid\v1;

class ChartController extends Controller
{
    public function OralChartsData(){
        $attain_levels = FinalAttainment::select('oral')->where("user_id", session()->get("user_id"))->first();
        $OralTotalMarks = CriteriaModel::select("oral_total")->where("user_id", session()->get('user_id'))->first();
        $data= array();
        $constraints = array();
        for($i=1; $i <=5; $i++){
            $stdOralMarks = OralModel::join("student_details", "student_details.id", "oral.id")
                                ->where("deleted_at", "=", null)
                                ->where("user_key", session()->get("user_id"))
                                ->where("oral_marks", "<" ,(($OralTotalMarks->oral_total)/5)*$i)
                                ->where("oral_marks", ">=", (($OralTotalMarks->oral_total)/5)*($i-1))
                                ->distinct('student_details.id')->count();
            array_push($constraints, (($OralTotalMarks->oral_total)/5)*($i-1)."-".(($OralTotalMarks->oral_total)/5)*($i));
            array_push($data, $stdOralMarks);
        }

        return response()->json([
            "levels" => $attain_levels,
            "data" => $data,
            "constraints" => json_encode($constraints)
        ]);

    }


    public function EndsemChartsData(){
        $attain_levels = FinalAttainment::select('endsem')->where("user_id", session()->get("user_id"))->first();
        $EndsemTotalMarks = CriteriaModel::select("endsem_total")->where("user_id", session()->get('user_id'))->first();
        $data= array();
        $constraints = array();
        for($i=1; $i <=5; $i++){
            $stdEndsemMarks = EndsemModel::join("student_details", "student_details.id", "endsem.id")
                                ->where("deleted_at", "=", null)
                                ->where("user_key", session()->get("user_id"))
                                ->where("endsem_mark", "<" ,(($EndsemTotalMarks->endsem_total)/5)*$i)
                                ->where("endsem_mark", ">=", (($EndsemTotalMarks->endsem_total)/5)*($i-1))
                                ->distinct('student_details.id')->count();
            array_push($constraints, (($EndsemTotalMarks->endsem_total)/5)*($i-1)."-".(($EndsemTotalMarks->endsem_total)/5)*($i));
            array_push($data, $stdEndsemMarks);
        }

        return response()->json([
            "levels" => $attain_levels,
            "data" => $data,
            "constraints" => json_encode($constraints)
        ]);
    }

    public function AssignChartsData(){
        $attain_levels = FinalAttainment::select('assignments')->where("user_id", session()->get("user_id"))->first();
        $AssignTotalMarks = CriteriaModel::select("assign_total")->where("user_id", session()->get('user_id'))->first();
        $data1= array();
        $constraints1 = array();
        for($i=1; $i <=5; $i++){
            $stdEndsemMarks = AssignmentModel::join("student_details", "student_details.id", "assignments.id")
                                ->where("deleted_at", "=", null)
                                ->where("user_key", session()->get("user_id"))
                                ->where("a1", "<=" ,(($AssignTotalMarks->assign_total)/5)*$i)
                                ->where("a1", ">", (($AssignTotalMarks->assign_total)/5)*($i-1))
                                ->distinct('student_details.id')->count();
            array_push($constraints1, (($AssignTotalMarks->assign_total)/5)*($i-1)." <= ".(($AssignTotalMarks->assign_total)/5)*($i));
            array_push($data1, $stdEndsemMarks);
        }

        $data2= array();
        $constraints2 = array();
        for($i=1; $i <=5; $i++){
            $stdEndsemMarks = AssignmentModel::join("student_details", "student_details.id", "assignments.id")
                                ->where("deleted_at", "=", null)
                                ->where("user_key", session()->get("user_id"))
                                ->where("a2", "<=" ,(($AssignTotalMarks->assign_total)/5)*$i)
                                ->where("a2", ">", (($AssignTotalMarks->assign_total)/5)*($i-1))
                                ->distinct('student_details.id')->count();
            array_push($constraints2, (($AssignTotalMarks->assign_total)/5)*($i-1)." <= ".(($AssignTotalMarks->assign_total)/5)*($i));
            array_push($data2, $stdEndsemMarks);
        }


        return response()->json([
            "levels" => $attain_levels,
            "data1" => $data1,
            "constraints1" => json_encode($constraints1),
            "data2" => $data2,
            "constraints2" => json_encode($constraints2)
        ]);
    }

    public function IAChartsData(){
        $attain_levels = FinalAttainment::select('ia')->where("user_id", session()->get("user_id"))->first();
        $Ia1TotalMarks = CriteriaModel::select("ia1_total")->where("user_id", session()->get('user_id'))->first();
        $Ia2TotalMarks = CriteriaModel::select("ia2_total")->where("user_id", session()->get('user_id'))->first();
        $data1= array();
        $constraints1 = array();
        for($i=1; $i <=5; $i++){
            $stdEndsemMarks = IaModel::join("student_details", "student_details.id", "ia.id")
                                ->where("deleted_at", "=", null)
                                ->where("user_key", session()->get("user_id"))
                                ->where("ia1", "<" ,(($Ia1TotalMarks->ia1_total)/5)*$i)
                                ->where("ia1", ">=", (($Ia1TotalMarks->ia1_total)/5)*($i-1))
                                ->distinct('student_details.id')->count();
            array_push($constraints1, (($Ia1TotalMarks->ia1_total)/5)*($i-1)." - ".(($Ia1TotalMarks->ia1_total)/5)*($i));
            array_push($data1, $stdEndsemMarks);
        }

        $data2= array();
        $constraints2 = array();
        for($i=1; $i <=5; $i++){
            $stdEndsemMarks = IaModel::join("student_details", "student_details.id", "ia.id")
                                ->where("deleted_at", "=", null)
                                ->where("user_key", session()->get("user_id"))
                                ->where("ia2", "<" ,(($Ia2TotalMarks->ia2_total)/5)*$i)
                                ->where("ia2", ">=", (($Ia2TotalMarks->ia2_total)/5)*($i-1))
                                ->distinct('student_details.id')->count();
            array_push($constraints2, (($Ia2TotalMarks->ia2_total)/5)*($i-1)." - ".(($Ia2TotalMarks->ia2_total)/5)*($i));
            array_push($data2, $stdEndsemMarks);
        }


        return response()->json([
            "levels" => $attain_levels,
            "data1" => $data1,
            "constraints1" => json_encode($constraints1),
            "data2" => $data2,
            "constraints2" => json_encode($constraints2)
        ]);
    }

    public function ExptChartsData(){
        $attain_levels = FinalAttainment::select('experiments')->where("user_id", session()->get("user_id"))->first();

        return response()->json([
            "levels" => $attain_levels
        ]);
    }
}
