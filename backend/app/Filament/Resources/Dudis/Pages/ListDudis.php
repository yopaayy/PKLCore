<?php

namespace App\Filament\Resources\Dudis\Pages;

use App\Filament\Resources\Dudis\DudiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDudis extends ListRecords
{
    protected static string $resource = DudiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
