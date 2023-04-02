<?php

namespace App\Http\Controllers;

use App\Exports\CisExport;
use App\Exports\OralExport;
use App\Imports\StudentsImport;
use App\Models\OralModel;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;

class UploadsController extends Controller
{
    public function xlsView()
    {
        return view('xls-input');
    }

    public function importStudents(Request $req)
    {

        $req->validate([
            'xlsfile' => 'required|max:100|mimes:xlsx, csv'
        ]);

        $excelImport = Excel::import(new StudentsImport, $req->file('xlsfile'));
        // dd($req);
        session()->flash("alertMsg", "All Students Added successfully, goto Students section.");
        return redirect()->back();
    }

    public function exportCIS()
    {
        return Excel::download(new CisExport, 'cis-subject.xlsx');
    }

    public function exportOral()
    {
        $students = OralModel::join('student_details', 'student_details.id', 'oral.id')
            ->select('oral_id', 'oral_marks', 'student_details.id', 'roll_no', 'student_id', 'name', 'div', 'gender')
            ->where('user_key', '=', session()->get('user_id'))
            ->where("deleted_at", "=", null)
            ->orderBy('roll_no', 'ASC')
            ->get()->toArray();
        return Excel::download(new OralExport($students), 'oral-subject.xlsx');
    }
}
