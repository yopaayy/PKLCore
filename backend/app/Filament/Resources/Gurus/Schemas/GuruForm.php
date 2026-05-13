<?php

namespace App\Filament\Resources\Gurus\Schemas;

// Pastikan import Section dari Schemas, bukan Forms (Standar Filament v5)
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kredensial Akun Guru')
                    ->description('Data untuk login ke sistem web/aplikasi.')
                    ->schema([
                        // Tampil saat edit
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Nama Akun Terdaftar')
                            ->disabled()
                            ->visibleOn('edit')
                            ->columnSpanFull(),

                        // Tampil saat create
                        TextInput::make('name')
                            ->label('Nama Lengkap Guru')
                            ->required()
                            ->maxLength(255)
                            ->hiddenOn('edit'),
                        TextInput::make('email')
                            ->label('Email Akses')
                            ->email()
                            ->required()
                            ->unique('users', 'email')
                            ->hiddenOn('edit'),
                        TextInput::make('password')
                            ->label('Password Sementara')
                            ->password()
                            ->required()
                            ->hiddenOn('edit'),
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->placeholder('Contoh: 081234567890')
                            ->numeric()
                            ->hiddenOn('edit')
                            ->helperText('Agar peringatan kelengkapan data profil tidak muncul.'),
                    ])->columns(2),

                Section::make('Data Kepegawaian')
                    ->description('Informasi administrasi pendidik.')
                    ->schema([
                        TextInput::make('nip')
                            ->label('NIP Guru')
                            ->required()
                            ->mask('99999999 999999 9 999')
                            ->stripCharacters(' ')
                            // Kita ganti validasi HTML dengan validasi Backend Murni
                            ->rule('digits:18') // Harus berupa angka dan TEPAT berjumlah 18 digit
                            ->unique('gurus', 'nip', ignoreRecord: true)
                            ->placeholder('Contoh: 19860926 201505 1 001')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
