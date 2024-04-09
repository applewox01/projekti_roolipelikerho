<?php

namespace App\Filament\Resources\WorldsResource\Pages;

use App\Filament\Resources\WorldsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorlds extends ListRecords
{
    protected static string $resource = WorldsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
