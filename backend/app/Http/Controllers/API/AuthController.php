<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', // Default role
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Kredensial tidak valid'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }

    // Fungsi penting untuk melengkapi data agar lolos Middleware Gatekeeper
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->has('whatsapp_number')) $user->whatsapp_number = $request->whatsapp_number;
        if ($request->has('address')) $user->address = $request->address;

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            $path = $request->file('photo')->store('profile_photos', 'public');
            $user->photo_path = $path;
        }

        // Cek apakah semua data krusial sudah terisi
        if ($user->whatsapp_number && $user->address && $user->photo_path) {
            $user->is_profile_completed = true;
        }

        $user->save();

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'is_completed' => $user->is_profile_completed,
            'data' => $user
        ]);
    }
}
