<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CisController extends Controller
{
    public function CisSheet(){

        return view('cis');
    }
}
