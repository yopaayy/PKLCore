<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        // Validasi input dari Flutter (hanya butuh jumlah dan metode)
        $request->validate([
            'jumlah_bayar' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $buktiPath = $request->file('bukti_transfer')->store('bukti_pembayaran', 'public');
        }

        // Logic Inti: Otomatis menggunakan nomor WA dari setting profil user
        $pembayaran = Pembayaran::create([
            'user_id' => $user->id,
            'nomor_whatsapp_pembayar' => $user->whatsapp_number, // Ditarik otomatis!
            'jumlah_bayar' => $request->jumlah_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer_path' => $buktiPath,
            'status' => 'Pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan pembayaran berhasil dicatat. Menunggu verifikasi admin.',
            'data' => $pembayaran
        ], 201);
    }

    // Fungsi untuk melihat histori pembayaran user tersebut
    public function index(Request $request)
    {
        $pembayaran = Pembayaran::where('user_id', $request->user()->id)->get();
        return response()->json(['data' => $pembayaran]);
    }
}
