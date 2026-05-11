<?php

namespace App\Filament\Resources\Dudis\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class DudisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_perusahaan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('bidang_usaha')
                    ->searchable(),
                TextColumn::make('kuota_siswa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_kerjasama')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Pending' => 'warning',
                        'Tidak Aktif' => 'danger',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_kerjasama')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Pending' => 'Pending',
                        'Tidak Aktif' => 'Tidak Aktif',
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
