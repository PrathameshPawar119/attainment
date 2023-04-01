<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CO_Expt extends Model
{
    use HasFactory;
    protected $table = 'co_expt';
    protected $primaryKey = 'co_expt_id';

    protected $fillable = [
        'CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(signup_details::class);
    }
}
