<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    // Fungsi ini mencegat data sebelum di-insert ke tabel 'siswas'
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Buat akun User (Flutter) di latar belakang
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'siswa', // Hardcode role siswa
            'whatsapp_number' => $data['whatsapp_number'] ?? null,
        ]);

        // 2. Hubungkan ID user yang baru dibuat ke data Siswa
        $data['user_id'] = $user->id;

        // 3. Hapus data akun dari array agar tidak error saat disimpan ke tabel siswas
        unset($data['name']);
        unset($data['email']);
        unset($data['password']);
        unset($data['whatsapp_number']);

        // Kembalikan data yang sudah bersih (hanya berisi nisn, kelas, dudi_id, dll)
        return $data;
    }

    protected function afterCreate(): void
    {
        // Memberi pesan sukses dan mengarahkan user
        Notification::make()
            ->title('Akun Siswa Berhasil Dibuat')
            ->success()
            ->send();
    }
}
