<?php

namespace App\Filament\Pages;

use App\Models\Scenario;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Pages\Scenarios\Pages;

class Scenarios extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $recordTitleAttribute = 'Skenaariot';
    protected static ?string $navigationLabel = 'Skenaariot';
    protected static ?string $title = 'Skenaariot';
    protected static ?string $navigationIcon = 'rpg-scroll-unfurled';

    protected static string $view = 'filament.pages.scenarios';

    public function table(Table $table): Table
    {
        return $table
            ->query(Scenario::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('background_info')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('other_requirements')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lvl_highest'),
                TextColumn::make('lvl_lowest'),
                TextColumn::make('plr_most'),
                TextColumn::make('plr_least'),
                TextColumn::make('admin_desc')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(function (Scenario $scenario) {
                        $scenario->delete();
                    })
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
                Action::make('edit')
            ]);
    }
}
