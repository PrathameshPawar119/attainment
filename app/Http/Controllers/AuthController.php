<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\signup_details;
use Illuminate\Support\Facades\Hash;
use App\Models\CriteriaModel;
use App\Models\CO_Oral_Endsem_Assign;
use App\Models\CO_IA;
use App\Models\CO_Expt;
use App\Models\FinalAttainment;
use App\Models\POModel;
use App\Models\ThresholdModel;

class AuthController extends Controller
{

    public function index()
    {
        return view('signup');
    }

    public function signup_user(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'username' => 'required | unique:signup_details',
            'password' => 'required | min:6| confirmed'
        ]);

        $user = new signup_details(); // new user
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->password = $request['password'];  // password gets autohashed by mutator
        $user->save();

        $this->PutUserSession($user->username, $user->email, $user->user_id);

        $last_tuple = signup_details::select('user_id')->where('username', "=", $user->username)->first();

        // init criteria marks entry
        $crt_tuple = new CriteriaModel();
        $crt_tuple->user_id = $last_tuple['user_id'];
        $crt_tuple->save();

        // init Co tables entry
        // table common for oral, endsem, assigns
        $co_group3s = new CO_Oral_Endsem_Assign();
        $co_group3s->user_id = $last_tuple['user_id'];
        $co_group3s->save();

        //table for ias
        $co_ia_tuple = new CO_IA();
        $co_ia_tuple->user_id = $last_tuple['user_id'];
        $co_ia_tuple->save();

        //table for experiments
        $co_expt_tuple = new CO_Expt();
        $co_expt_tuple->user_id = $last_tuple['user_id'];
        $co_expt_tuple->save();

        //table for threshold marks
        $th_table = new ThresholdModel();
        $th_table->oral = 55;
        $th_table->endsem = 42;
        $th_table->assigns = 65;
        $th_table->ia = 55;
        $th_table->expt = 65;
        $th_table->user_id = $last_tuple['user_id'];
        $th_table->save();

        // final_attainment table
        $finAttain = new FinalAttainment();
        $finAttain->user_id = $last_tuple['user_id'];
        $finAttain->save();

        // PO Table
        $po_table = new POModel();
        $po_table->user_id = $last_tuple["user_id"];
        $po_table->save();

        return redirect("/students/view");
    }

    public function login_user(Request $request)
    {
        $request->validate([
            'user_credential' => 'required',
            'login_password' => 'required | min:6'
        ]);

        $user = signup_details::where('email', '=', $request['user_credential'])->orwhere('username', '=', $request['user_credential'])->first();
        if ($user) {
            $varify = password_verify($request['login_password'], $user->password);
            if ($varify) {

                // Put UserDetails in session
                $this->PutUserSession($user->username, $user->email, $user->user_id);

                session()->flash("alertMsg", "Welcome $user->username");
                return redirect("students/input");
            } else {
                session()->flash("alertMsg", "Wrong credentials, Please try again !");
                return redirect()->back();
            }
        } else {
            session()->flash("alertMsg", "Wrong credentials, User not found !");
            return redirect()->back();
        }
    }

    public function logout_user()
    {
        session()->forget('username');
        session()->forget('user_email');
        session()->forget('user_id');

        session()->flash("alertMsg", "Logged Out, Your work has been saved successfully!");
        return redirect('auth/login');
    }
}
