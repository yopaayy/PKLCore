<?php

namespace App\Filament\Resources\Dudis;

use App\Filament\Resources\Dudis\Pages\CreateDudi;
use App\Filament\Resources\Dudis\Pages\EditDudi;
use App\Filament\Resources\Dudis\Pages\ListDudis;
use App\Filament\Resources\Dudis\Schemas\DudiForm;
use App\Filament\Resources\Dudis\Tables\DudisTable;
use App\Models\Dudi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DudiResource extends Resource
{
    protected static ?string $model = Dudi::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static \UnitEnum|string|null $navigationGroup = 'Data Utama';

    protected static string|null $modelLabel = 'Perusahaan DU/DI';

    protected static ?string $recordTitleAttribute = 'nama_perusahaan';

    public static function form(Schema $schema): Schema
    {
        return DudiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DudisTable::configure($table);
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
            'index' => ListDudis::route('/'),
            'create' => CreateDudi::route('/create'),
            'edit' => EditDudi::route('/{record}/edit'),
        ];
    }
}
