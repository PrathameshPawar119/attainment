<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalAttainment extends Model
{
    use HasFactory;
    protected $table = 'final_attainments';
    protected $primaryKey = 'final_attainments_id';

    protected $fillable = [
        'oral',
        'endsem',
        'assignments',
        'ia',
        'experiments',
        'user_id'
    ];

    public function User(){
        return $this->hasOne('signup_details', 'user_id');
    }

}
