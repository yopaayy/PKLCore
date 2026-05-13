<?php

namespace App\Filament\Resources\Pembayarans\Tables;




use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
// --- PASTIKAN MENGGUNAKAN NAMESPACE ACTION V5 ---
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nomor_whatsapp_pembayar')
                    ->label('WhatsApp')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('jumlah_bayar')
                    ->label('Jumlah')
                    ->money('IDR') // Langsung format ke Rupiah otomatis
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Approved' => 'success', // Ubah dari Verified menjadi Approved
                        'Pending' => 'warning',
                        'Rejected' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved', // Ubah dari Verified menjadi Approved
                        'Rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->label('Review'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
