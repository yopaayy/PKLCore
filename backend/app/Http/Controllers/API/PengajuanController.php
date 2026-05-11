<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan histori pengajuan milik siswa yang sedang login
        $pengajuan = Pengajuan::with('dudi')->where('user_id', $request->user()->id)->get();
        return response()->json(['data' => $pengajuan]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'dudi_id' => 'required|exists:dudis,id',
            'pesan_siswa' => 'nullable|string',
        ]);

        // Proteksi: Cek apakah siswa sudah punya pengajuan aktif
        $pengajuanAktif = Pengajuan::where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->first();

        if ($pengajuanAktif) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah memiliki pengajuan yang sedang diproses atau disetujui.'
            ], 403);
        }

        $pengajuan = Pengajuan::create([
            'user_id' => $user->id,
            'dudi_id' => $request->dudi_id,
            'pesan_siswa' => $request->pesan_siswa,
            'status' => 'Pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan PKL berhasil dikirim. Menunggu persetujuan Admin/Guru.',
            'data' => $pengajuan
        ], 201);
    }
}
