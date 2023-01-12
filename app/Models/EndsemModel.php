<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndsemModel extends Model
{
    use HasFactory;
    protected $table = "endsem";
    protected $primaryKey = "endsem_id";

    protected $fillable = [
        'endsem_mark',
        'id'
    ];

    public function User(){
        return $this->hasOne(StudentDetails::class, 'id');
    }
    
}
