<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentDetails;
use App\Models\ThresholdModel;
use App\Models\CriteriaModel;

class signup_details extends Model
{
    use HasFactory;
    protected $table = 'signup_details';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email', 'username', 'password'
    ];

    // Mutator --> to modify password to password hash before putting it in DB.
    public function setPasswordAttribute($password){
        $hash_method = 'PASSWORD_BCRYPT';
        $this->attributes['password'] = password_hash($password, constant($hash_method));
    }

    public function Students(){
        return $this->hasMany(StudentDetails::class);
    }

    public function threshold(){
        return $this->hasOne(ThresholdModel::class, 'user_id');
    }

    public function criteria(){
        return $this->hasOne(CriteriaModel::class, 'user_id');
    }

    public function FinalAttainment(){
        return $this->hasOne(FinalAttainment::class, 'user_id');
    }
    
}
