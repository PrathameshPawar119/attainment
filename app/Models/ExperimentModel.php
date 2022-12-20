<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperimentModel extends Model
{
    use HasFactory;
    protected $table = 'experiments';
    protected $primaryKey = 'experiments_id';
}
