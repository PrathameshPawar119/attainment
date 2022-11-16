<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signup_details extends Model
{
    use HasFactory;
    protected $table = 'signup_details';
    protected $primaryKey = 'user_id';

    public function setPasswordAttribute($password){

        $hash_method = 'PASSWORD_BCRYPT';
        $this->attributes['password'] = password_hash($password, constant($hash_method));
    }
    
}
