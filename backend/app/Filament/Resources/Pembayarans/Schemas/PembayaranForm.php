<?php

namespace App\Filament\Resources\Pembayarans\Schemas;


use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\User;
use Filament\Schemas\Schema;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pembayar')
                    ->description('Pilih siswa untuk memproses verifikasi pembayaran.')
                    ->schema([
                        Select::make('user_id')
                            ->label('Nama Siswa')
                            // Mengambil user yang rolenya 'siswa' saja
                            ->options(User::where('role', 'siswa')->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->live() // Agar perubahan memicu update pada field lain (WhatsApp)
                            ->disabledOn('edit') // Dikunci hanya saat EDIT, agar saat CREATE bisa dipilih
                            ->afterStateUpdated(function ($state, $set) {
                                // Otomatis tarik nomor WhatsApp saat siswa dipilih
                                $user = User::find($state);
                                if ($user) {
                                    $set('nomor_whatsapp_pembayar', $user->whatsapp_number);
                                }
                            }),

                        TextInput::make('nomor_whatsapp_pembayar')
                            ->label('WhatsApp (Profil)')
                            ->placeholder('Akan terisi otomatis...')
                            ->helperText(fn($state) => empty($state) ? '⚠️ Siswa ini belum melengkapi nomor WhatsApp di profil!' : 'Data WhatsApp tersedia.')
                            ->disabled()
                            ->dehydrated(), // Tetap simpan ke DB meskipun di-disable di UI

                        TextInput::make('jumlah_bayar')
                            ->label('Jumlah Bayar')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->placeholder('Contoh: 500000'),
                    ])->columns(3),

                Section::make('Tindakan Verifikasi Admin')
                    ->schema([
                       Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Approved' => 'Approved',
                                'Rejected' => 'Rejected',
                            ])
                            ->required()
                            ->native(false)
                            ->default('Pending')
                            ->label('Keputusan (Status)'),
                    ]),
            ]);
    }
}
