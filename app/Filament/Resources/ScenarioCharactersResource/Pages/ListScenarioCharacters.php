<?php

namespace App\Filament\Resources\ScenarioCharactersResource\Pages;

use App\Filament\Resources\ScenarioCharactersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScenarioCharacters extends ListRecords
{
    protected static string $resource = ScenarioCharactersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
