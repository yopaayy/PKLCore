<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    public function index()
    {
        $dudis = Dudi::with('user')->get();
        return response()->json(['data' => $dudis]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_perusahaan' => 'required|string',
            'bidang_usaha' => 'required|string',
            'kuota_siswa' => 'integer'
        ]);

        $dudi = Dudi::create($request->all());
        return response()->json(['message' => 'Data DU/DI berhasil ditambahkan', 'data' => $dudi], 201);
    }

    public function show($id)
    {
        $dudi = Dudi::with(['user', 'siswas'])->findOrFail($id);
        return response()->json(['data' => $dudi]);
    }

    public function update(Request $request, $id)
    {
        $dudi = Dudi::findOrFail($id);
        $dudi->update($request->all());
        return response()->json(['message' => 'Data DU/DI berhasil diupdate', 'data' => $dudi]);
    }

    public function destroy($id)
    {
        Dudi::destroy($id);
        return response()->json(['message' => 'Data DU/DI berhasil dihapus']);
    }
}
