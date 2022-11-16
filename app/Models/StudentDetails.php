<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    use HasFactory;
    protected $table = "student_details";
    protected $priamaryKey = "id";

    // this function capitalies each 
    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

}
