<?php

namespace App\Filament\Resources\CharactersResource\Pages;

use App\Filament\Resources\CharactersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacters extends EditRecord
{
    protected static string $resource = CharactersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
