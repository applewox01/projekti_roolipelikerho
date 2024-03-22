<?php

namespace App\Filament\Resources\CharactersResource\Pages;

use App\Filament\Resources\CharactersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacters extends CreateRecord
{
    protected static string $resource = CharactersResource::class;
}
