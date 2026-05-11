<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'nisn',
        'kelas',
        'guru_id',
        'dudi_id',
        'status_pkl'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
}
