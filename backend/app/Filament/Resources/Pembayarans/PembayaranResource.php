<?php

namespace App\Filament\Resources\Pembayarans;

use App\Filament\Resources\Pembayarans\Pages\CreatePembayaran;
use App\Filament\Resources\Pembayarans\Pages\EditPembayaran;
use App\Filament\Resources\Pembayarans\Pages\ListPembayarans;
use App\Filament\Resources\Pembayarans\Schemas\PembayaranForm;
use App\Filament\Resources\Pembayarans\Tables\PembayaransTable;
use App\Models\Pembayaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    protected static \UnitEnum|string|null $navigationGroup = 'Administrasi';

    protected static string|null $modelLabel = 'Verifikasi Pembayaran';

    protected static ?string $recordTitleAttribute = 'nomor_whatsapp_pembayar';

    public static function form(Schema $schema): Schema
    {
        return PembayaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PembayaransTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPembayarans::route('/'),
            'create' => CreatePembayaran::route('/create'),
            'edit' => EditPembayaran::route('/{record}/edit'),
        ];
    }
}
