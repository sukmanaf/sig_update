<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bangunan extends Model
{
    use HasFactory;
     protected $fillable = [
        'd_nop',
        'geom',
    ];
}
