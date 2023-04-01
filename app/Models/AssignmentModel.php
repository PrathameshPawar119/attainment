<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentDetails;

class AssignmentModel extends Model
{
    use HasFactory;
    protected $table = "assignments";
    protected $primaryKey = "assignments_id";
    
    protected $fillable = [
        'a1p1',
        'a1p2',
        'a1p3',
        'a1',
        'a2p1',
        'a2p2',
        'a2p3',
        'a2',
        'id'
    ];

    public function student(){
        return $this->belongsTo(StudentDetails::class);
    }
}
