<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nisn')
                    ->required(),
                TextInput::make('kelas')
                    ->required(),
                TextInput::make('guru_id')
                    ->numeric(),
                TextInput::make('dudi_id')
                    ->numeric(),
                Select::make('status_pkl')
                    ->options([
            'Belum Pengajuan' => 'Belum pengajuan',
            'Menunggu Approval' => 'Menunggu approval',
            'Aktif PKL' => 'Aktif p k l',
            'Selesai' => 'Selesai',
        ])
                    ->default('Belum Pengajuan')
                    ->required(),
            ]);
    }
}
