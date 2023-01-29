<?php

namespace App\Http\Controllers;

use App\Events\StudentCreated;
use App\Events\StudentDeleted;
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
        $total_tuples = $this->totalNumStd();
        $last_record = StudentDetails::where("user_key", "=", session()->get('user_id'))->latest()->first();
        $divs = StudentDetails::Divs;
        $genders = StudentDetails::Genders;
        return view("input", compact('total_tuples', 'last_record', 'divs', 'genders'));
    }
    
    public function addStudent(Request $req){
        $divs = StudentDetails::Divs;
        $genders = StudentDetails::Genders;
        $req->validate([
            'roll_no'=> 'required',
            'student_id'=>'required | unique:student_details',
            'div' => 'required | in:'.current($divs).','.next($divs).','.next($divs).','.next($divs),
            'student_name' => 'required | min:5 | max:80',
            'gender' => 'required | in:'.current($genders).','.next($genders).','.next($genders).','.next($genders)
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

            
            $last_tuple = StudentDetails::select('id')->where("user_key", "=", session()->get('user_id'))->latest()->first();

            $data = array('id'=>$last_tuple->id);
            if($student){
                // Init student entries in all associative tables
                event(new StudentCreated($data));
            }

            session()->flash("alertMsg", "Student - $student->name ($student->student_id) saved successfully !");
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

    // soft deleting student (Moving to Trash)
    public function deleteStudent($id){
        $student = StudentDetails::withoutTrashed()->find($id);
        if (!is_null($student)) {
            $student->delete();
        }
        session()->flash("alertMsg", "Student - $student->name ($student->student_id) moved to Trash.");
        return redirect()->back();
    }

    public function permDelete($id){
        if($id){
            // Delete Student from all associative tables
            $data = array('id' => $id);
            event(new StudentDeleted($data));
        }
        
        $student = StudentDetails::onlyTrashed()->find($id);
        if (!is_null($student)) {
            $student->forceDelete();
        }
        session()->flash("alertMsg", "Student - $student->name ($student->student_id) deleted permnantly.");
        return redirect()->back();
    }

    public function restoreFromTrash($id){
        $student = StudentDetails::onlyTrashed()->find($id);
        if ($student) {
            $student->restore();
        }
        session()->flash("alertMsg", "Student - $student->name ($student->student_id) restored successfully.");
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
            
            session()->flash("alertMsg", "Student Information of - $student->name ($student->student_id) updated.");
            return redirect('/students/view');
        }
        else{
            //flashing duplicate entry error to students view only once 
            session()->flash("duplicateRecordError", "Student with Roll number $req->roll_no in Div $req->div allready present, check again please !");
            return redirect()->back();
        }
    }
    
}
