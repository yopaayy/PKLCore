<?php

namespace App\Filament\Resources\Pembayarans\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pembayar')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled() // Admin tidak boleh sembarang ubah pembayar
                            ->label('Nama Siswa'),
                        TextInput::make('nomor_whatsapp_pembayar')
                            ->label('WhatsApp (Auto-extracted)')
                            ->disabled(),
                        TextInput::make('jumlah_bayar')
                            ->prefix('IDR')
                            ->numeric()
                            ->required(),
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Lunas' => 'Lunas',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->required()
                            ->native(false),
                    ])->columns(2),

                Section::make('Bukti Transaksi')
                    ->schema([
                        FileUpload::make('bukti_transfer_path')
                            ->label('Struk Bukti Transfer')
                            ->image()
                            ->directory('bukti_pembayaran')
                            ->openable() // Bisa diklik untuk diperbesar
                            ->downloadable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
