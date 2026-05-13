<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;
        $data = $this->form->getRawState();

        // Jika yang dibuat adalah Guru
        if ($user->role === 'guru') {
            $user->guru()->create([
                'nip' => $data['nip'],
            ]);
        }

        // Jika yang dibuat adalah DU/DI
        if ($user->role === 'dudi') {
            $user->dudi()->create([
                'nama_perusahaan' => $data['nama_perusahaan'],
                'bidang_usaha' => $data['bidang_usaha'],
                'status_kerjasama' => 'Aktif',
            ]);
        }
    }
}
