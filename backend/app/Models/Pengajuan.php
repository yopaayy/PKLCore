<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'user_id',
        'dudi_id',
        'status',
        'pesan_siswa',
        'catatan_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
}
