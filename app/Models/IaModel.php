<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaModel extends Model
{
    use HasFactory;
    protected $table = 'ia';
    protected $primaryKey = 'ia_id';
}
