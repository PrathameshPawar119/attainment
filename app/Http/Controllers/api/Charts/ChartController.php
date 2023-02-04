<?php

namespace App\Http\Controllers\api\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FinalAttainment;
use App\Models\CriteriaModel;
use App\Models\OralModel;

use function Ramsey\Uuid\v1;

class ChartController extends Controller
{
    public function OralChartsData(){
        $attain_levels = FinalAttainment::select('oral')->where("user_id", session()->get("user_id"))->first();
        // $OralTotalMarks = CriteriaModel::select("oral_total")->where("user_id", session()->get('user_id'))->first();
        // $stdOralMarks = OralModel::join("student_details", "student_details.id", "oral.id")
        //                     ->select('oral_marks')
        //                     ->where("deleted_at", "=", null)
        //                     ->where("user_key", session()->get("user_id"))
        //                     ->get();

        return response()->json([
            "levels" => $attain_levels
        ]);

    }


    public function EndsemChartsData(){
        $attain_levels = FinalAttainment::select('endsem')->where("user_id", session()->get("user_id"))->first();

        return response()->json([
            "levels" => $attain_levels
        ]);
    }

    public function AssignChartsData(){
        $attain_levels = FinalAttainment::select('assignments')->where("user_id", session()->get("user_id"))->first();

        return response()->json([
            "levels" => $attain_levels
        ]);
    }

    public function IAChartsData(){
        $attain_levels = FinalAttainment::select('ia')->where("user_id", session()->get("user_id"))->first();

        return response()->json([
            "levels" => $attain_levels
        ]);
    }

    public function ExptChartsData(){
        $attain_levels = FinalAttainment::select('experiments')->where("user_id", session()->get("user_id"))->first();

        return response()->json([
            "levels" => $attain_levels
        ]);
    }
}
