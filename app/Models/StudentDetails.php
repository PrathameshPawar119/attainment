<?php

namespace App\Models;

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
        $this->attributes['student_id'] = strtoupper($value);
    }


}
