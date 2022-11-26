<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SheetsController extends Controller
{
    
    public function index(){

    }

    public function oralSheet(){

        return view('oral');
    }
}
