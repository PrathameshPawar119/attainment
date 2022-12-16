<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OralModel;
use App\Models\EndsemModel;

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
                                
        $trashBtn = "Oral/Practical Attainment";
        return view('oral', compact('students', 'trashBtn'));
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
        $trashBtn = "End-Sem Attainment";
        return view("endsem", compact('students', 'trashBtn', 'searchText'));
    }
}
