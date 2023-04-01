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

    public function students(){
        return $this->hasMany(StudentDetails::class);
    }

    public function threshold(){
        return $this->hasOne(ThresholdModel::class);
    }

    public function criteria(){
        return $this->hasOne(CriteriaModel::class);
    }

    public function final_attainment(){
        return $this->hasOne(FinalAttainment::class);
    }

    public function po_models()
    {
        return $this->hasOne(POModel::class);
    }



    public function co_expt()
    {
        return $this->hasOne(CO_Expt::class);
    }
    public function co_ia()
    {
        return $this->hasOne(CO_IA::class);
    }
    public function co_oral_endsem_assign()
    {
        return $this->hasOne(CO_Oral_Endsem_Assign::class);
    }
    
}
