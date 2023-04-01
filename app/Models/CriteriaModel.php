<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaModel extends Model
{
    use HasFactory;
    protected $table = 'criteria';
    protected $primaryKey = 'criteria_id';

    public function getDummyAttribute(){
        return 0;
    }

    public function user(){
        return $this->belongsTo(signup_details::class);
    }
}
