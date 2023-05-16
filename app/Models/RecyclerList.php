<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecyclerList extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'system_id',
        'address',
        'serial_number'
    ];
}
