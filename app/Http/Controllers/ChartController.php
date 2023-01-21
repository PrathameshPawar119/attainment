<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CO_Oral_Endsem_Assign;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(){

    }

    public function OralChartsData(){
        return response()->json("Oral Charts Data here");
    }
}
