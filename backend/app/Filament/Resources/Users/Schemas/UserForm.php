<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kredensial Akun')
                    ->description('Data login utama untuk pengguna.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255)
                            ->label('Password Baru'),
                        Select::make('role')
                            ->options([
                                'superadmin' => 'Super Admin',
                                'admin' => 'Admin Sekolah',
                                'guru' => 'Guru Pembimbing',
                                'dudi' => 'Perwakilan DU/DI',
                            ])
                            ->required()
                            ->native(false)
                            ->live(), // Menjadikan form reaktif terhadap perubahan role
                    ])->columns(2),

                // SECTION KHUSUS GURU (Hanya muncul jika role = guru)
                Section::make('Data Kelengkapan Guru')
                    ->description('Informasi tambahan spesifik untuk tenaga pendidik.')
                    ->schema([
                        TextInput::make('nip')
                            ->label('NIP Guru')
                            ->numeric()
                            ->required(),
                    ])
                    ->hidden(fn(Get $get) => $get('role') !== 'guru'),

                // SECTION KHUSUS DU/DI (Hanya muncul jika role = dudi)
                Section::make('Data Kelengkapan DU/DI')
                    ->description('Informasi tambahan spesifik untuk mitra industri.')
                    ->schema([
                        TextInput::make('nama_perusahaan')
                            ->required(),
                        TextInput::make('bidang_usaha')
                            ->required(),
                    ])
                    ->hidden(fn(Get $get) => $get('role') !== 'dudi'),
            ]);
    }
}
