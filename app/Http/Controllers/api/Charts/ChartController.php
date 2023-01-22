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
        $user_id = session()->get('user_id');
        $attain_levels = FinalAttainment::select('oral')->where("user_id", $user_id)->first();
        json_decode($attain_levels);
        $OralTotalMarks = CriteriaModel::select("oral_total")->where("user_id", $user_id)->first();
        $stdOralMarks = OralModel::join("student_details", "student_details.id", "oral.id")
                            ->select('oral_marks')
                            ->where("deleted_at", "=", null)
                            ->where("user_key", $user_id)
                            ->get();

        return response()->json([
            "OralTotalMarks" => $OralTotalMarks
        ]);
    }
}
