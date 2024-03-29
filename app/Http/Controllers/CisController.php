<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FinalAttainment;
use App\Models\POModel;
use Illuminate\Http\Request;

class CisController extends Controller
{
    public function CisSheet()
    {
        $user_id = session()->get('user_id');
        $attain_levels = FinalAttainment::select("oral", "endsem", "assignments", "ia", "experiments")->where("user_id", $user_id)->first();

        $po_levels = POModel::select("PO1", "PO2", "PO3", "PO4", "PO5", "PO6")
            ->where("user_id", "=", $user_id)->first();


        return view('cis', compact('attain_levels', 'attain_levels', 'po_levels'));
    }
}
