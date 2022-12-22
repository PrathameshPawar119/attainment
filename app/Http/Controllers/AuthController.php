<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\signup_details;
use Illuminate\Support\Facades\Hash;
use App\Models\CriteriaModel;

class AuthController extends Controller
{

    public function index(){
        return view('signup');
    }

    public function signup_user(Request $request){
        $request->validate([
            'email'=> 'required | email',
            'username'=>'required | unique:signup_details',
            'password'=>'required | min:6| confirmed'
        ]);

        $user = new signup_details(); // new user
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->password = $request['password'];  // password gets autohashed by mutator
        $user->save();

        $last_tuple = signup_details::latest()->first();

    // init criteria marks entry
        $crt_tuple = new CriteriaModel();
        $crt_tuple->oral_total = 0;
        $crt_tuple->endsem_total = 0;
        $crt_tuple->assign_p1 = 0;
        $crt_tuple->assign_p2 = 0;
        $crt_tuple->assign_p3 = 0;
        $crt_tuple->ia1_q1 = 0;
        $crt_tuple->ia1_q2 = 0;
        $crt_tuple->ia1_q3 = 0;
        $crt_tuple->ia1_q4 = 0;
        $crt_tuple->ia2_q1 = 0;
        $crt_tuple->ia2_q2 = 0;
        $crt_tuple->ia2_q3 = 0;
        $crt_tuple->ia2_q4 = 0;
        $crt_tuple->exp_r1 = 0;
        $crt_tuple->exp_r2 = 0;
        $crt_tuple->exp_r3 = 0;
        $crt_tuple->user_id = $last_tuple['user_id'];
        $crt_tuple->save();

        return redirect("/students/view");
    }

    public function login_user(Request $request){
        $request->validate([
            'user_credential'=> 'required',
            'login_password'=>'required | min:6'
        ]);

        $user = signup_details::where('email', '=', $request['user_credential'])->orwhere('username', '=', $request['user_credential'])->first();
        if ($user) {
            $varify = password_verify($request['login_password'], $user->password);
            if($varify){
                session()->put("username", $user->username);
                session()->put("user_email", $user->email);
                session()->put("user_id", $user->user_id);
                return redirect("students/input");
            }
            else {
                return "Wrong Password";
            }
        }
        else{
            return "User Not found";
        }
    }

    public function logout_user(){
        session()->forget('username');
        session()->forget('user_email');
        session()->forget('user_id');

        return redirect('auth/login');
    }




}
