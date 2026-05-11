<?php

namespace App\Filament\Resources\Pengajuans;

use App\Filament\Resources\Pengajuans\Pages\CreatePengajuan;
use App\Filament\Resources\Pengajuans\Pages\EditPengajuan;
use App\Filament\Resources\Pengajuans\Pages\ListPengajuans;
use App\Filament\Resources\Pengajuans\Schemas\PengajuanForm;
use App\Filament\Resources\Pengajuans\Tables\PengajuansTable;
use App\Models\Pengajuan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    // Masukkan ke grup Workflow/Manajemen
    protected static \UnitEnum|string|null $navigationGroup = 'Workflow PKL';

    protected static string|null $modelLabel = 'Approval Pengajuan';

    protected static ?string $recordTitleAttribute = 'status';

    public static function form(Schema $schema): Schema
    {
        return PengajuanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengajuansTable::configure($table);
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
            'index' => ListPengajuans::route('/'),
            'create' => CreatePengajuan::route('/create'),
            'edit' => EditPengajuan::route('/{record}/edit'),
        ];
    }
}
