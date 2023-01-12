<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OralModel extends Model
{
    use HasFactory;
    protected $table = "oral";
    protected $primaryKey = "oral_id";

    protected $fillable = [
        'oral_marks', 'id'
    ];

    
    public function User(){
        return $this->hasOne(StudentDetails::class, 'id');
    }
}
