<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RclRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'recycler_id',
        'theme_id',
        'solution_id',

    ];


}
