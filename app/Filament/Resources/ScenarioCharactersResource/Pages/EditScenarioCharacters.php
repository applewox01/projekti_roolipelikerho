<?php

namespace App\Filament\Resources\ScenarioCharactersResource\Pages;

use App\Filament\Resources\ScenarioCharactersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScenarioCharacters extends EditRecord
{
    protected static string $resource = ScenarioCharactersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
