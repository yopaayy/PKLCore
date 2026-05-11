<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pengajuan;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

// Route khusus untuk mencetak PDF
Route::get('/cetak-surat-pengantar/{id}', function ($id) {
    $pengajuan = Pengajuan::with(['user.siswa', 'dudi'])->findOrFail($id);

    // Opsional: Cek jika statusnya belum approved, jangan izinkan cetak
    if ($pengajuan->status !== 'Approved') {
        abort(403, 'Surat hanya bisa dicetak untuk pengajuan yang sudah disetujui.');
    }

    $pdf = Pdf::loadView('pdf.surat_pengantar', compact('pengajuan'));

    // Mengunduh file dengan nama dinamis
    return $pdf->download('Surat_Pengantar_' . $pengajuan->user->name . '.pdf');
})->name('cetak.surat.pengantar')->middleware('auth'); // Dilindungi auth web Filament
