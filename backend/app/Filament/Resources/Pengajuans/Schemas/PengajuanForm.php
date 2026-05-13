<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

// Pastikan menggunakan Namespace Section v5
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\User;
use App\Models\Pembayaran;

class PengajuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pengajuan')
                    ->schema([
                        Select::make('user_id')
                            ->label('Siswa Pengaju')
                            ->options(function () {
                                // LOGIKA KETAT: Ambil ID siswa yang pembayarannya sudah "Approved"
                                $siswaLunasIds = Pembayaran::where('status', 'Approved')->pluck('user_id');

                                // Tampilkan hanya User ber-role 'siswa' yang ID-nya ada di daftar Lunas
                                return User::where('role', 'siswa')
                                    ->whereIn('id', $siswaLunasIds)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->required()
                            ->disabledOn('edit') // Kunci agar admin tidak bisa mengganti siswa saat di mode edit
                            ->helperText('Hanya siswa dengan status pembayaran "Approved" yang dapat diajukan.'),

                        Select::make('dudi_id')
                            ->relationship('dudi', 'nama_perusahaan')
                            ->label('Perusahaan (DU/DI) Dituju')
                            ->searchable()
                            ->required()
                            ->disabledOn('edit'),

                        Textarea::make('pesan_siswa')
                            ->label('Pesan siswa')
                            ->disabledOn('edit')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Tindakan Admin')
                    ->schema([
                        Select::make('status')
                            ->label('Keputusan (Status)')
                            // Wajib menggunakan huruf kapital mengikuti enum Database
                            ->options([
                                'Pending' => 'Pending',
                                'Approved' => 'Approved',
                                'Rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('Pending')
                            ->native(false),

                        Textarea::make('catatan_admin')
                            ->label('Catatan/Alasan (Opsional)')
                            ->placeholder('Berikan alasan jika ditolak, atau pesan jika disetujui...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
