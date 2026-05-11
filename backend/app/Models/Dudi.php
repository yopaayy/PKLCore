<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'bidang_usaha',
        'latitude',
        'longitude',
        'kuota_siswa',
        'status_kerjasama'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
