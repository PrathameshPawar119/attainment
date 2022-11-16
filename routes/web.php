<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\studentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(["prefix"=>"/auth"], function(){
    Route::get("/login", function(){return view('login');});
    Route::get("signup_page", [AuthController::class, "index"]);
    Route::post("signup_user", [AuthController::class, "signup_user"]);
    Route::post("login_user", [AuthController::class, "login_user"]);
    Route::get('logout', [AuthController::class, "logout_user"]);
});

Route::group(["prefix"=>"/students", "middleware"=>'loginRedirect'], function(){
    Route::get("", [studentController::class, 'index']);
    Route::get("input", [studentController::class, 'inputForm']);
    Route::post("input/addstudent", [studentController::class, 'addStudent']);
});