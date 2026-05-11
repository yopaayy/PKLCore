<?php

namespace App\Filament\Resources\Pembayarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nomor_whatsapp_pembayar')
                    ->label('WhatsApp')
                    ->copyable() // Admin bisa langsung copy nomor WA
                    ->searchable(),
                TextColumn::make('jumlah_bayar')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Lunas' => 'success',
                        'Pending' => 'warning',
                        'Ditolak' => 'danger',
                    }),
                ImageColumn::make('bukti_transfer_path')
                    ->label('Bukti')
                    ->circular(),
                TextColumn::make('created_at')
                    ->label('Tanggal Bayar')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Lunas' => 'Lunas',
                        'Ditolak' => 'Ditolak',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->label('Verifikasi'), // Mengubah tombol edit jadi 'Verifikasi'
            ]);
    }
}
