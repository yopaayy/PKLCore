<?php

namespace App\Filament\Resources\Siswas\Tables;


use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class SiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Mengambil nama dari tabel users
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'), // Ditebalkan agar menonjol

                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),

                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),

                // Mengambil nama_perusahaan dari tabel dudis
                TextColumn::make('dudi.nama_perusahaan')
                    ->label('Tempat PKL')
                    ->placeholder('Belum Plotting') // Muncul jika DUDI masih kosong
                    ->searchable()
                    ->sortable(),

                // Mengambil nama guru dari tabel users (melalui relasi guru)
                TextColumn::make('guru.user.name')
                    ->label('Guru Pembimbing')
                    ->placeholder('Belum Ditentukan') // Muncul jika Guru masih kosong
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status_pkl')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Belum Pengajuan' => 'gray',
                        'Menunggu Approval' => 'warning',
                        'Aktif PKL' => 'success',
                        'Selesai' => 'info',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_pkl')
                    ->label('Filter Status')
                    ->options([
                        'Belum Pengajuan' => 'Belum Pengajuan',
                        'Menunggu Approval' => 'Menunggu Approval',
                        'Aktif PKL' => 'Aktif PKL',
                        'Selesai' => 'Selesai',
                    ]),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
