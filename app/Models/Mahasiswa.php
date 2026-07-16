<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['user_id', 'nama', 'nim', 'prodi', 'angkatan', 'ipk', 'email', 'github', 'bio'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'ipk' => 'decimal:2',
        'angkatan' => 'integer',
    ];
}
