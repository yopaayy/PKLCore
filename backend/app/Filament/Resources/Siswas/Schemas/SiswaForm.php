<?php

namespace App\Filament\Resources\Siswas\Schemas;

// Pastikan import ini terpasang agar tidak error "Class not found"
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kredensial Akun (Login Aplikasi Flutter)')
                    ->description('Data ini akan digunakan siswa untuk masuk ke aplikasi seluler.')
                    ->schema([
                        // Tampil saat edit: Hanya menampilkan nama akun yang sudah tertaut
                        Select::make('user_id') // Ubah menjadi Select dan arahkan ke foreign key
                            ->relationship('user', 'name') // Tarik relasinya
                            ->label('Nama Akun Terdaftar')
                            ->disabled() // Kunci agar tidak bisa diubah (read-only)
                            ->visibleOn('edit')
                            ->columnSpanFull(),

                        // Tampil saat create: Meminta data untuk membuat akun baru
                        TextInput::make('name')
                            ->label('Nama Lengkap Siswa')
                            ->required()
                            ->maxLength(255)
                            ->hiddenOn('edit'),
                        TextInput::make('email')
                            ->label('Email (Untuk Login)')
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
                            ->helperText('Penting: Akan otomatis ditarik saat sistem pembayaran.'),
                    ])->columns(2),

                Section::make('Data Akademik & Plotting')
                    ->description('Informasi sekolah dan penempatan praktik industri.')
                    ->schema([
                        TextInput::make('nisn')
                            ->label('NISN')
                            ->required()
                            // Memastikan panjangnya tepat 10 karakter
                            ->minLength(10)
                            ->maxLength(10)
                            // Validasi Regex: Memastikan yang diketik HANYA angka 0-9
                            ->regex('/^[0-9]+$/')
                            // Memastikan NISN unik di tabel siswas (abaikan saat sedang mode edit)
                            ->unique('siswas', 'nisn', ignoreRecord: true)
                            ->placeholder('Contoh: 0009321234'),
                        TextInput::make('kelas')
                            ->required()
                            ->placeholder('Contoh: XII RPL 1')
                            ->maxLength(255),
                        Select::make('dudi_id')
                            ->relationship('dudi', 'nama_perusahaan')
                            ->searchable()
                            ->preload()
                            ->label('Tempat PKL (DU/DI)'),
                        Select::make('guru_id')
                            ->relationship('guru', 'nip')
                            ->searchable()
                            ->preload()
                            ->label('Guru Pembimbing (NIP)'),
                        Select::make('status_pkl')
                            ->options([
                                'Belum Pengajuan' => 'Belum Pengajuan',
                                'Menunggu Approval' => 'Menunggu Approval',
                                'Aktif PKL' => 'Aktif PKL',
                                'Selesai' => 'Selesai',
                            ])
                            ->required()
                            ->default('Belum Pengajuan')
                            ->label('Status Saat Ini'),
                    ])->columns(2),
            ]);
    }
}
