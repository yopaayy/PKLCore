<?php

namespace App\Filament\Resources\Gurus\Pages;

use App\Filament\Resources\Gurus\GuruResource;
use Filament\Resources\Pages\CreateRecord;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Ciptakan akun User di latar belakang
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'guru', // Kunci paten sebagai guru
            'whatsapp_number' => $data['whatsapp_number'] ?? null,
        ]);

        // 2. Tautkan ID-nya
        $data['user_id'] = $user->id;

        // 3. Bersihkan sisa array sebelum masuk ke tabel gurus
        unset($data['name'], $data['email'], $data['password'], $data['whatsapp_number']);

        return $data;
    }
}
