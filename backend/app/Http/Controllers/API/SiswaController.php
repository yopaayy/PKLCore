<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil data siswa beserta relasi user, dudi, dan gurunya
        $siswas = Siswa::with(['user', 'dudi', 'guru'])->get();
        return response()->json(['data' => $siswas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nisn' => 'required|string|unique:siswas',
            'kelas' => 'required|string'
        ]);

        $siswa = Siswa::create($request->all());
        return response()->json(['message' => 'Data Siswa berhasil ditambahkan', 'data' => $siswa], 201);
    }

    public function show($id)
    {
        $siswa = Siswa::with(['user', 'dudi', 'guru'])->findOrFail($id);
        return response()->json(['data' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json(['message' => 'Data Siswa berhasil diupdate', 'data' => $siswa]);
    }

    public function destroy($id)
    {
        Siswa::destroy($id);
        return response()->json(['message' => 'Data Siswa berhasil dihapus']);
    }
}
