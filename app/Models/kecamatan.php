<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
     protected $fillable = [
        'd_kd_kec',
        'd_kd_kel',
    ];
}
