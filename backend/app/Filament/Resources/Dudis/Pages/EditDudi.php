<?php

namespace App\Filament\Resources\Dudis\Pages;

use App\Filament\Resources\Dudis\DudiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDudi extends EditRecord
{
    protected static string $resource = DudiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
