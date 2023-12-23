<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class managementUser extends Model
{
    use HasFactory;
    protected $tabel = 'users';
     protected $fillable = [
        'id',
        'nama',
        'email',
    ];
}
