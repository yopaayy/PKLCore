<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengajuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pengajuan')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled()
                            ->label('Siswa Pengaju'),
                        Select::make('dudi_id')
                            ->relationship('dudi', 'nama_perusahaan')
                            ->disabled()
                            ->label('Perusahaan (DU/DI) Dituju'),
                        Textarea::make('pesan_siswa')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Tindakan Admin')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Approved' => 'Approved',
                                'Rejected' => 'Rejected',
                            ])
                            ->required()
                            ->native(false)
                            ->label('Keputusan (Status)'),
                        Textarea::make('catatan_admin')
                            ->label('Catatan/Alasan (Opsional)')
                            ->placeholder('Berikan alasan jika ditolak, atau pesan jika disetujui...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
