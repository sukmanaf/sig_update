<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desa extends Model
{
    use HasFactory;
     protected $fillable = [
        'd_kd_kel',
        'd_nm_kel',
    ];
}
