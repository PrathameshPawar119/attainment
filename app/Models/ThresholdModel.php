<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThresholdModel extends Model
{
    use HasFactory;
    // This privete variables can be accessed only in methods of child classes
    protected $table = "threshold_marks";
    protected $primaryKey = "threshold_marks_id";
}
