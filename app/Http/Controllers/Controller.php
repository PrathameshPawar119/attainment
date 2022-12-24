<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\CriteriaModel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public static $criteiaTotalMarks = array(1,2);
    // public function __construct($criteiaTotalMarks){
    //     $this->criteiaTotalMarks = $criteiaTotalMarks;
    // }
    // public function getCriteiaTotalMarks(){
    //     $this->criteiaTotalMarks = CriteriaModel::join('signup_details', 'signup_details.user_id', 'criteria.user_id')
    //         ->select('criteria.user_id', 'criteria.oral_total', 'criteria.endsem_total', 'criteria.assign_total', 'criteria.ia1_total', 'criteria.ia2_total', 'criteria.exp_total')
    //         ->where("criteria.user_id", "=", session()->get('user_id'))
    //         ->get();
    //     return $this->criteiaTotalMarks[0];
    // }
}
