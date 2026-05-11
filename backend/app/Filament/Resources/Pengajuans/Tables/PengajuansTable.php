<?php

namespace App\Filament\Resources\Pengajuans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PengajuansTable
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
                TextColumn::make('dudi.nama_perusahaan')
                    ->label('Tempat Tujuan')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Approved' => 'success',
                        'Pending' => 'warning',
                        'Rejected' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->label('Review'),

                // Tambahan Tombol Cetak PDF
                Action::make('cetak_surat')
                    ->label('Cetak Surat')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn(\App\Models\Pengajuan $record) => route('cetak.surat.pengantar', $record->id))
                    ->openUrlInNewTab() // Buka PDF di tab baru
                    // Tombol ini HANYA muncul jika statusnya Approved
                    ->visible(fn(\App\Models\Pengajuan $record) => $record->status === 'Approved'),
            ]);
    }
}
