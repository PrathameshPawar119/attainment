<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Co_Total_Expt extends Model
{
    use HasFactory;
    protected $table = 'co_total_expt';
    protected $primaryKey = 'co_total_expt_id';

    protected $fillable = [
        'CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6', 'id'
    ];

    public function User(){
        return $this->hasone(StudentDetails::class, "user_id");
    }
}
