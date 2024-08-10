<?php

namespace App\Filament\Pages;

use App\Models\Scenario;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Actions\Action as HeaderAction;
use Filament\Tables\Actions\ActionGroup;

class Scenarios extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $recordTitleAttribute = 'Skenaariot';
    protected static ?string $navigationLabel = 'Skenaariot';
    protected static ?string $title = 'Skenaariot';
    protected static ?string $navigationIcon = 'rpg-scroll-unfurled';

    protected static string $view = 'filament.pages.scenarios';

    protected function getHeaderActions(): array
    {
        return [
            HeaderAction::make('create')
                ->label('Luo uusi skenaario')
                ->url(route('filament.admin.pages.scenario-create'))
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->outlined(true),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Scenario::query()->orderBy('lvl_lowest', 'asc')->orderBy('plr_least', 'asc'))
            ->columns([
                TextColumn::make('name')
                    ->label('Nimi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Kuvaus')
                    ->html()
                    ->words(5),
                TextColumn::make('background_info')
                    ->label('Taustatiedot')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('other_requirements')
                    ->label('Muut vaatimukset')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lvl_highest')
                    ->label('Korkein taso')
                    ->sortable(),
                TextColumn::make('lvl_lowest')
                    ->label('Matalin taso')
                    ->sortable(),
                TextColumn::make('plr_most')
                    ->label('Eniten pelaajia')
                    ->sortable(),
                TextColumn::make('plr_least')
                    ->label('Vähiten pelaajia')
                    ->sortable(),
                TextColumn::make('world.name')
                    ->label('Maailma')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('admin_desc')
                    ->label('Ylläpitäjän kuvaus')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Luotu')
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Päivitetty')
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('edit')
                        ->url(fn (Scenario $scenario): string => route('filament.admin.pages.scenario-edit', ['edit' => $scenario]))
                        ->openUrlInNewTab()
                        ->name('Muokkaa')
                        ->icon('heroicon-o-pencil')
                        ->color('primary'),
                    Action::make('delete')
                        ->name('Poista')
                        ->action(fn (Scenario $record) => $record->delete())
                        ->requiresConfirmation()
                        ->modalHeading('Poista skenaario')
                        ->modalDescription('Haluatko varmasti poistaa skenaarion?')
                        ->modalSubmitActionLabel('Kyllä, poista skenaario')
                        ->icon('heroicon-o-trash')
                        ->color('danger'),
                ])
            ])
            ->emptyStateHeading('Ei skenaarioita');
    }
}
