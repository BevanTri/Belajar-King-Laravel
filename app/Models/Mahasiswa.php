<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nama', 'nim', 'prodi', 'angkatan', 'ipk', 'email', 'github', 'bio'];

    protected $casts = [
        'ipk' => 'decimal:2',
        'angkatan' => 'integer',
    ];
}
