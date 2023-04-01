<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaModel extends Model
{
    use HasFactory;
    protected $table = 'ia';
    protected $primaryKey = 'ia_id';

    protected $fillable = [
        'ia1q1',
        'ia1q2',
        'ia1q3',
        'ia1q4',
        'ia2q1',
        'ia2q2',
        'ia2q3',
        'ia2q4',
        'id'
    ];

    
    public function student(){
        return $this->belongsTo(StudentDetails::class);
    }
}
