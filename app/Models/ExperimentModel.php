<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperimentModel extends Model
{
    use HasFactory;
    protected $table = 'experiments';
    protected $primaryKey = 'experiments_id';

    protected $fillable = [
        'e1r1','e1r2','e1r3','e2r1','e2r2','e2r3','e3r1','e3r2','e3r3','e4r1','e4r2','e4r3','e5r1','e5r2','e5r3','e6r1','e6r2','e6r3','e7r1','e7r2','e7r3','e8r1',
        'e8r2','e8r3','e9r1','e9r2','e9r3','e10r1','e10r2','e10r3','e11r1','e11r2','e11r3','e12r1','e12r2','e12r3','id'
    ];

    
    public function student(){
        return $this->belongsTo(StudentDetails::class);
    }
}
