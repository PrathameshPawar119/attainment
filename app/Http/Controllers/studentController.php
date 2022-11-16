<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDetails;

class studentController extends Controller
{
    public function index(){
        return "students page here";
    }

    public function inputForm(){
        return view("input");
    }

    public function addStudent(Request $req){

        $req->validate([
            'roll_no'=> 'required | unique:student_details',
            'student_id'=>'required | unique:student_details',
            'div' => 'required | in:A,B',
            'student_name' => 'required | min:5 | max:80',
            'gender' => 'required | in:M,F'
        ]);

        $student = new StudentDetails();
        $student->roll_no = $req['roll_no'];
        $student->student_id = $req['student_id'];
        $student->div = $req['div'];
        $student->name = $req['student_name'];
        $student->gender = $req['gender'];
        $student->user_key = session()->get('user_id');
        $student->save();

        return redirect()->back();
    }
    
}
