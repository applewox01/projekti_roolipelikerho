<?php

namespace App\Filament\Resources\WorldsResource\Pages;

use App\Filament\Resources\WorldsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorlds extends EditRecord
{
    protected static string $resource = WorldsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
