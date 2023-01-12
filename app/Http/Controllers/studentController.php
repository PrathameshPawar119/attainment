<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDetails;
use App\Models\OralModel;
use App\Models\EndsemModel;
use App\Models\AssignmentModel;
use App\Models\Co_Total_Expt;
use App\Models\Co_Total_Ia;
use App\Models\IaModel;
use App\Models\ExperimentModel;

class studentController extends Controller
{
    public function index(){

    }

    public function inputForm(){
        $total_tuples = StudentDetails::where("user_key", "=", session()->get("user_id"))->select('id')->distinct()->count();
        return view("input", compact('total_tuples'));
    }
    
    public function addStudent(Request $req){
        $req->validate([
            'roll_no'=> 'required',
            'student_id'=>'required | unique:student_details',
            'div' => 'required | in:A,B',
            'student_name' => 'required | min:5 | max:80',
            'gender' => 'required | in:M,F'
        ]);
        
        // Group key is composite of roll_no + div + user_key
        // it will be useful to avoid duplictate entries for per user pre div
        $group_key = strval($req['roll_no'])."-".strval($req['div'])."-".strval(session()->get('user_id'));
        $duplicate = StudentDetails::where('group_key','=', $group_key)->get();

        
        if(count($duplicate)=== 0)                       
        {
            $student = new StudentDetails();
            $student->roll_no = $req['roll_no'];
            $student->student_id = $req['student_id'];
            $student->div = $req['div'];
            $student->name = $req['student_name'];
            $student->gender = $req['gender'];
            $student->user_key = session()->get('user_id');
            $student->group_key = $group_key;
            $student->save();

            
            $last_tuple = StudentDetails::latest()->first();
        // init oral entry
            $oral_tuple = new OralModel();
            $oral_tuple->oral_marks = 0;
            $oral_tuple->id = $last_tuple['id'];
            $oral_tuple->save();

        //init endsem entry
            $endsem_tuple = new EndsemModel();
            $endsem_tuple->endsem_mark = 0;
            $endsem_tuple->id = $last_tuple['id'];
            $endsem_tuple->save();
            
        //init assignments entry
            $assign_tuple = new  AssignmentModel();
            $assign_tuple->id = $last_tuple['id'];
            $assign_tuple->save();

        // init ia entry
            $ia_tuple = new IaModel();
            $ia_tuple->id = $last_tuple['id'];
            $ia_tuple->save();

        // init experiments entry
            $expt_tuple = new ExperimentModel();
            $expt_tuple->id = $last_tuple['id'];
            $expt_tuple->save();

        // init co_total_ia table
            $co_ia_tuple = new Co_Total_Ia();
            $co_ia_tuple->id = $last_tuple['id'];
            $co_ia_tuple->save();
        // init co_total_expt_ table
            $co_expt_table = new Co_Total_Expt();
            $co_expt_table->id =  $last_tuple['id'];
            $co_expt_table->save();

            return redirect()->back();
            
        }
        else{
            //flashing duplicate error to students view 
            session()->flash("duplicateRecordError", "Student with Roll number $req->roll_no in Div $req->div allready present, check again please !");
            return redirect()->back();
        } 
        
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    public function viewStudents(Request $req){
        $search = $req['searchForm'] ?? ""; // can be or cannt
        if($search != "")
        {
            $students = StudentDetails::where("user_key", "=", (session()->get('user_id')))->where("name", "LIKE", "%$search%")->paginate(10);
        }
        else{
            $students = StudentDetails::where("user_key", "=", (session()->get('user_id')))->orderBy('roll_no', 'ASC')->paginate(10);
        }
        
        $viewEditBtn = "Edit";
        $viewEditURL = url('/students/view/edit');               
        $viewDeleteBtn = "Trash";
        $viewDeleteURL = url('/students/view/delete');
        $trashBtn = "Trash Data";
        $trashURL = url("/students/trash");
        return view('view')->with(compact('students', 'viewEditBtn', 'viewEditURL', 'viewDeleteBtn', 'viewDeleteURL', 'trashBtn', 'trashURL'));
    }

    // soft deleting student
    public function deleteStudent($id){
        $student = StudentDetails::withoutTrashed()->find($id);
        if (!is_null($student)) {
            $student->delete();
        }
        return redirect()->back();
    }

    public function permDelete($id){
        $oral_record = OralModel::where("id", "=", $id)->delete();
        $endsem_record = EndsemModel::where("id", "=", $id)->delete();
        $assign_record = AssignmentModel::where("id", "=", $id)->delete();
        $ia_record = IaModel::where("id", "=", $id)->delete();
        $expt_record = ExperimentModel::where("id", "=", $id)->delete();
        $co_ia_record = Co_Total_Ia::where("id", "=", $id)->delete();
        $co_expt_record = Co_Total_Expt::where("id", "=", $id)->delete();
        
        $student = StudentDetails::onlyTrashed()->find($id);
        if (!is_null($student)) {
            $student->forceDelete();
        }
        return redirect()->back();
    }

    public function restoreFromTrash($id){
        $student = StudentDetails::onlyTrashed()->find($id);
        if ($student) {
            $student->restore();
        }
        return redirect()->back();
    }

    // View Student trash
    public function viewStudentTrash(){
        $students = StudentDetails::onlyTrashed()->where("user_key", "=", (session()->get('user_id')))->paginate(10);
        $viewEditBtn = "Restore";
        $viewEditURL = url('/students/view/restore');
        $viewDeleteBtn = "Delete";
        $viewDeleteURL = url('/students/view/permdelete');
        $trashBtn = "Back to Students";
        $trashURL = url("/students/view");
        return view('view')->with(compact('students', 'viewEditBtn', 'viewEditURL', 'viewDeleteBtn', 'viewDeleteURL', 'trashBtn', 'trashURL'));
    }

    // Edit the student
    public function editStudent($id){
        $student = StudentDetails::find($id);
        if (is_null($student)) {
            return redirect()->back();
        }
        else{
            return view('edit-input')->with(compact('student'));
        }
    }

    public function updateStudentData($id, Request $req){
        $student = StudentDetails::find($id);

        if ($req->student_id === $student->student_id) {
            $req->validate([
                'roll_no'=> 'required',
                'student_id'=>'required',
                'div' => 'required | in:A,B',
                'student_name' => 'required | min:5 | max:80',
                'gender' => 'required | in:M,F'
            ]);
        }
        else{
            $req->validate([
                'roll_no'=> 'required',
                'student_id'=>'required | unique:student_details',
                'div' => 'required | in:A,B',
                'student_name' => 'required | min:5 | max:80',
                'gender' => 'required | in:M,F'
            ]); 
        }

        // Group key is composite of roll_no + div + user_key
        // it will be useful to avoid duplictate entries for per user pre div
        $group_key = strval($req['roll_no'])."-".strval($req['div'])."-".strval(session()->get('user_id'));
        $duplicate_grp = StudentDetails::where('group_key','=', $group_key)->get();


        if (count($duplicate_grp)<2) {
            $student->roll_no = $req['roll_no'];
            $student->student_id = $req['student_id'];
            $student->div = $req['div'];
            $student->name = $req['student_name'];
            $student->gender = $req['gender'];
            $student->user_key = session()->get('user_id');
            $student->group_key = $group_key;
            $student->save();
            
            return redirect('/students/view');
        }
        else{
            //flashing duplicate entry error to students view only once 
            session()->flash("duplicateRecordError", "Student with Roll number $req->roll_no in Div $req->div allready present, check again please !");
            return redirect()->back();
        }
    }
    
}
