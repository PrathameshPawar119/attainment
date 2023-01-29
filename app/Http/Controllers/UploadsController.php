<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadsController extends Controller
{
    public function xlsView(){
        return view('xls-input');
    }

    public function importStudents(Request $req){

        $req->validate([
            'xlsfile' => 'required|max:100|mimes:xlsx, csv'
        ]);

        $excelImport = Excel::import(new StudentsImport, $req->file('xlsfile'));
        // dd($req);
        session()->flash("alertMsg", "All Students Added successfully, goto Students section.");
        return redirect()->back();


        
    }
}
