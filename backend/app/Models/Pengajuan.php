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

    // --- LOGIKA OTOMATISASI (MAGIC TRIGGER) ---
    protected static function booted()
    {
        static::updated(function ($pengajuan) {
            // Jika status berubah dan menjadi 'Approved'
            if ($pengajuan->isDirty('status') && $pengajuan->status === 'Approved') {

                // Cari data siswa yang nyambung dengan user_id di pengajuan ini
                $siswa = \App\Models\Siswa::where('user_id', $pengajuan->user_id)->first();

                if ($siswa) {
                    // Otomatis masukkan siswa ke DU/DI tersebut dan ubah statusnya
                    $siswa->update([
                        'dudi_id' => $pengajuan->dudi_id,
                        'status_pkl' => 'Menunggu Approval' // Menunggu approval dari guru/sekolah tahap akhir
                    ]);
                }
            }
        });
    }
}
