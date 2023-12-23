<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nop extends Model
{
    use HasFactory;
     protected $fillable = [
        'd_nop',
        'd_luas',
        'geom',
    ];
}
