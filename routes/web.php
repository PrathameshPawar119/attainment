<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\SheetsController;
use App\Http\Controllers\UpdateMarksController;
use App\Models\IaModel;
use Spatie\LaravelIgnition\Http\Controllers\UpdateConfigController;

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
    Route::get("login", function(){return view('login');});
    Route::get("signup_page", [AuthController::class, "index"]);
    Route::post("signup_user", [AuthController::class, "signup_user"]);
    Route::post("login_user", [AuthController::class, "login_user"]);
    Route::get('logout', [AuthController::class, "logout_user"]);
});

Route::group(["prefix"=>"/students", "middleware"=>'loginRedirect'], function(){
    Route::get("view", [studentController::class, 'viewStudents']);
    Route::get("view/delete/{id}", [studentController::class, 'deleteStudent']);
    Route::get("view/permdelete/{id}", [studentController::class, 'permDelete']);
    Route::get("input", [studentController::class, 'inputForm']);
    Route::post("input/addstudent", [studentController::class, "addStudent"]);
    Route::get("trash", [studentController::class, "viewStudentTrash"]);
    Route::get("view/restore/{id}", [studentController::class, "restoreFromTrash"]);
    Route::get("view/edit/{id}", [studentController::class, "editStudent"]);
    Route::post("view/updatestudent/{id}", [studentController::class, "updateStudentData"]);
});

Route::group(["prefix"=>"/sheets", "middleware"=>"loginRedirect"], function (){
    Route::get("oral", [SheetsController::class, "oralSheet"]);
    Route::get("endsem", [SheetsController::class, "endsemSheet"]);
    Route::get("assignment", [SheetsController::class, "assignmentSheet"]);
    Route::get("ia", [SheetsController::class, "iaSheet"]);
    Route::get("experiments", [SheetsController::class, "experimentSheet"]);
    Route::post("oral/update", [UpdateMarksController::class, "updateOralMarks"])->middleware("RefineNullInputMware")->name("updateOralMarks");
    Route::post("endsem/update", [UpdateMarksController::class, "updateEndsemMarks"])->middleware("RefineNullInputMware")->name("updateEndsemMarks");
    Route::post("assignment/update", [UpdateMarksController::class, "updateAssignmentMarks"])->middleware("RefineNullInputMware")->name("updateAssignmentMarks");
    Route::post("ia/update", [UpdateMarksController::class, "updateIaMarks"])->middleware("RefineNullInputMware")->name("updateIaMarks");
    Route::post("experiments/update", [UpdateMarksController::class, "updateExperimentMarks"])->middleware("RefineNullInputMware")->name("updateExperimentMarks");
});

Route::group(["prefix"=>"/user", "middleware"=>"loginRedirect"], function(){
    Route::get("criteriaInput", [SheetsController::class, "criteriaInput"]);
    Route::post("updateCriteriaMarks", [UpdateMarksController::class, "updateCriteriaMarks"])->middleware("RefineNullInputMware")->name("updateCriteriaMarks");
    Route::get("coinput", [SheetsController::class, "coInput"]);
    Route::get("thresholdMarksInput", [SheetsController::class, "thresholdMarksInput"]);
    Route::post("updateCoInputCheck1", [updateMarksController::class, "updateCoInputCheck1"])->name("updateCoInputCheck1");
    Route::post("updateCoInputCheck2", [UpdateMarksController::class, "updateCoInputCheck2"])->name("updateCoInputCheck2");
    Route::get("sendPreviousChecksRecords", [SheetsController::class, "sendPreviousChecksRecords"])->name("sendPreviousChecksRecords");
    Route::post("updateThresholdCriteria", [UpdateMarksController::class, "updateThresholdCriteria"])->name("updateThresholdCriteria");
});