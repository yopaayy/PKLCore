<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menciptakan Akun Superadmin Otomatis yang Sempurna
        User::create([
            'name' => 'Super Administrator',
            'email' => 'admin@pklcore.com',
            'password' => Hash::make('password123'), // Silakan ganti sesuai selera
            'role' => 'superadmin',
            // Opsional: jika Anda punya kolom is_profile_completed, aktifkan agar admin tidak kena limit
            // 'is_profile_completed' => true,
        ]);

        // Anda juga bisa menambahkan akun DUDI atau Guru dummy di sini nanti jika perlu
    }
}
