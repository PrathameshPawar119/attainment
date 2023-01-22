<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POModel extends Model
{
    use HasFactory;
    protected $table = 'p_o_models';
    protected $primaryKey = 'p_o_models_id';

    protected $fillable = [
        'PO1', 'PO2', 'PO3', 'PO4', 'PO5', 'PO6', 'user_id'
    ];

    public function User(){
        return $this->hasone(signup_details::class, "user_id");
    }
}
