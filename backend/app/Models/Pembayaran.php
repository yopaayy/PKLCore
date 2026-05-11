<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_whatsapp_pembayar',
        'jumlah_bayar',
        'metode_pembayaran',
        'status',
        'bukti_transfer_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
