<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CO_Oral_Endsem_Assign extends Model
{
    use HasFactory;
    protected $table = 'co_oral_endsem_assign';
    protected $primaryKey = 'co_oral_endsem_assign_id';

    protected $fillable = [
        'oral_co', 'endsem_co', 'assign1_co', 'assign2_co', 'user_id'
    ];

    public function User(){
        return $this->hasone(signup_details::class, "user_id");
    }
}
