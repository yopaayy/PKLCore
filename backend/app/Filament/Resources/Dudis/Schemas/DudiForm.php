<?php

namespace App\Filament\Resources\Dudis\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DudiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Perusahaan')
                    ->description('Detail data industri tempat PKL.')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label('Akun Login Perwakilan'),
                        TextInput::make('nama_perusahaan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('bidang_usaha')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('kuota_siswa')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Select::make('status_kerjasama')
                            ->options([
                                'Aktif' => 'Aktif',
                                'Pending' => 'Pending',
                                'Tidak Aktif' => 'Tidak Aktif',
                            ])
                            ->required()
                            ->default('Aktif'),
                    ])->columns(2),

                Section::make('Koordinat Lokasi (Live Map)')
                    ->description('Titik GPS untuk validasi radius absensi siswa.')
                    ->schema([
                        TextInput::make('latitude')
                            ->numeric()
                            ->columnSpan(1),
                        TextInput::make('longitude')
                            ->numeric()
                            ->columnSpan(1),
                    ])->columns(2),
            ]);
    }
}
