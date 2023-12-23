<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usulan extends Model
{
    use HasFactory;
     protected $fillable = [
        'usulan',
        'status',
        'nop',
    ];
}
