<?php

namespace App\Models;

use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDetails extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "student_details";
    protected $priamaryKey = "id";

    protected $fillable = [
        'roll_no', 'student_id', 'name', 'div', 'gender', 'user_key', 'group_key'
    ];


    // Divisions
    public const A = 'A';
    public const B = 'B';

    public const Divs = [
        self::A => 'A',
        self::B => 'B',
    ];

    // Genders
    public const M = 'M';
    public const F = 'F';

    public const Genders = [
        self::M => 'M',
        self::F => 'F',
    ];

    //  Mutators **************************
    // this function capitalies each leteters 1st char
    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    // capitalize whole student id 
    // student_id --> StudentId for mutators 🥲
    public function setStudentIdAttribute($value){
        // $student_dups = StudentDetails::where("user_key", "=", session()->get('user_id'))->where('student_id', $value)->distinct('id')->count();
        // if($student_dups > 1){
        //     throw ValidationException::withMessages(["student_id" => "Student with same ID is present"]);
        //     return redirect()->back();
        // }
        $this->attributes['student_id'] = strtoupper($value);
    }

    public function oral()
    {
        return $this->hasOne(OralModel::class);
    }
    public function endsem()
    {
        return $this->hasOne(EndsemModel::class);
    }
    public function ia()
    {
        return $this->hasOne(IaModel::class);
    }
    public function assignment()
    {
        return $this->hasOne(AssignmentModel::class);
    }
    public function experiment()
    {
        return $this->hasOne(ExperimentModel::class);
    }
    public function co_total_ia()
    {
        return $this->hasOne(Co_Total_Ia::class);
    }
    public function co_total_expt()
    {
        return $this->hasOne(Co_Total_Expt::class);
    }
    

    public function user()
    {
        return $this->belongsTo(signup_details::class);
    }
   


}
