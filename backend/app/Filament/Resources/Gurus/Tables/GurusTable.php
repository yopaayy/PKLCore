<?php

namespace App\Filament\Resources\Gurus\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class GurusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Guru')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nip')
                    ->label('Nomor Induk Pegawai (NIP)')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    // Memformat ulang 18 digit menjadi ada spasi saat ditampilkan
                    ->formatStateUsing(function (string $state) {
                        // Pastikan panjangnya pas 18 digit
                        if (strlen($state) === 18) {
                            return substr($state, 0, 8) . ' ' . substr($state, 8, 6) . ' ' . substr($state, 14, 1) . ' ' . substr($state, 15, 3);
                        }
                        return $state;
                    }),

                // Fitur Enterprise: Otomatis menghitung siswa bimbingannya
                TextColumn::make('siswas_count')
                    ->counts('siswas')
                    ->label('Siswa Dibimbing')
                    ->badge()
                    ->color('info'),
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
