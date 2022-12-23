<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OralModel;
use App\Models\EndsemModel;
use App\Models\AssignmentModel;
use App\Models\CriteriaModel;
use App\Models\IaModel;
use App\Models\ExperimentModel;

class SheetsController extends Controller
{
    
    public function index(){

    }

    public function oralSheet(Request $req){
        $searchText = $req['searchForm'] ?? ""; // can be or cannot
        if ($searchText != "") {
            $students = OralModel::join('student_details', 'student_details.id', 'oral.id')
                                    ->select('oral.*', 'student_details.*')
                                    ->where('user_key', '=', session()->get('user_id'))
                                    ->where('name', 'LIKE', "%$searchText%")
                                    ->where("deleted_at", "=", null)
                                    ->orWhere('student_id', 'LIKE', "%$searchText%")
                                    ->paginate(10);
                                }
        else{
            $students = OralModel::join('student_details', 'student_details.id', 'oral.id')
                                    ->select('oral.*', 'student_details.*')
                                    ->where('user_key', '=', session()->get('user_id'))
                                    ->where("deleted_at", "=", null)
                                    ->orderBy('roll_no', 'ASC')
                                    ->paginate(10);
                                }
        
        $oral_total_max = CriteriaModel::where("user_id", "=", session()->get("user_id"))->select("oral_total")->get();
        $trashBtn = "Oral/Practical Attainment";
        return view('oral', compact('students', 'trashBtn', 'oral_total_max'));
    }

    public function endsemSheet(Request $req){
        $searchText = $req['searchForm'] ?? "";
        if ($searchText != "") {
            $students = EndsemModel::join('student_details', 'student_details.id', 'endsem.id')
                            ->select('endsem.*','student_details.*')
                            ->where('name', "LIKE", "%$searchText%")
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
            }
        else{
            $students = EndsemModel::join('student_details', 'student_details.id', 'endsem.id')
                            ->select('endsem.*','student_details.*')
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
                        }

        $endsem_total_max = CriteriaModel::where("user_id", "=", session()->get("user_id"))->select("endsem_total")->get();
        $trashBtn = "End-Sem Attainment";
        return view("endsem", compact('students', 'trashBtn', 'searchText', 'endsem_total_max'));
    }

    
    public function assignmentSheet(Request $req){
        $searchText = $req['searchForm'] ?? "";
        if ($searchText != "") {
            $students = AssignmentModel::join('student_details', 'student_details.id', 'assignments.id')
                            ->select('assignments.*','student_details.*')
                            ->where('name', "LIKE", "%$searchText%")
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
            }
        else{
            $students = AssignmentModel::join('student_details', 'student_details.id', 'assignments.id')
                            ->select('assignments.*','student_details.*')
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
                        }
        
        $assign_total_max = CriteriaModel::where("user_id", "=", session()->get("user_id"))->select("assign_total", "assign_p1", "assign_p2", "assign_p3")->get();
        $trashBtn = "Assignments Attainment";
        return view("assignment", compact('students', 'trashBtn', 'searchText', 'assign_total_max'));
    }

    public function iaSheet(Request $req){
        $searchText = $req['searchForm'] ?? "";
        if ($searchText != "") {
            $students = IaModel::join('student_details', 'student_details.id', 'ia.id')
                            ->select('ia.*','student_details.*')
                            ->where('name', "LIKE", "%$searchText%")
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
            }
        else{
            $students = IaModel::join('student_details', 'student_details.id', 'ia.id')
                            ->select('ia.*','student_details.*')
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
                        }

        $ia_total_max = CriteriaModel::where("user_id", "=", session()->get("user_id"))->select("ia1_q1", "ia1_q2", "ia1_q3", "ia1_q4", "ia1_total", "ia2_q1", "ia2_q2", "ia2_q3", "ia2_q4", "ia2_total")->get();
        $trashBtn = "IA Attainment";
        return view("ia", compact('students', 'trashBtn', 'searchText', 'ia_total_max'));
    }

    public function experimentSheet(Request $req){
        $searchText = $req['searchForm'] ?? "";
        if ($searchText != "") {
            $students = ExperimentModel::join('student_details', 'student_details.id', 'experiments.id')
                            ->select('experiments.*','student_details.*')
                            ->where('name', "LIKE", "%$searchText%")
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
            }
        else{
            $students = ExperimentModel::join('student_details', 'student_details.id', 'experiments.id')
                            ->select('experiments.*','student_details.*')
                            ->where("user_key", "=", session()->get("user_id"))
                            ->where("deleted_at", "=", null)
                            ->orderBy('roll_no', 'ASC')
                            ->paginate(10);
                        }

        $exp_total_max = CriteriaModel::where("user_id", "=", session()->get("user_id"))->select("exp_r1", "exp_r2", "exp_r3", "exp_total")->get();
        $trashBtn = "Expt Attainment";
        return view("experiment", compact('students', 'trashBtn', 'searchText', 'exp_total_max'));
    }

    public function criteriaInput(){
        $current_criteria = CriteriaModel::where("user_id", "=", session()->get("user_id"))->first();
        return view("criterias", compact('current_criteria'));
    }

    public function coInput(){
        return view("coinput");
    }
}
