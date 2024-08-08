<?php

namespace App\Filament\Pages;

use App\Models\characters;
use App\Models\Scenario;
use App\Models\scenario_characters;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ScenarioCharacters extends Page implements HasTable
{
    use InteractsWithTable;

    protected ?string $heading = 'Skenaariohahmojen hallinta';
    protected static ?string $navigationLabel = 'Skenaariohahmojen hallinta';
    protected static ?string $title = 'Skenaariohahmojen hallinta';

    protected static ?string $navigationParentItem = 'Hahmojen hallinta';

    protected static ?string $navigationGroup = 'Hahmot';

    protected static string $view = 'filament.pages.scenario-characters';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->name('Lisää hahmo skenaarioon')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->outlined(true)
                ->form([
                    Select::make('character_id')
                        ->label('Hahmo')
                        ->required()
                        ->searchable()
                        ->options(characters::all()->pluck('name', 'id')->toArray()),
                    Select::make('scenario_id')
                        ->label('Skenaario')
                        ->required()
                        ->searchable()
                        ->options(Scenario::all()->pluck('name', 'id')->toArray())
                ])
                ->action(function (array $data): void {
                    scenario_characters::create($data);

                    Notification::make()
                        ->title('Hahmo lisätty skenaarioon')
                        ->body('Hahmo lisätty skenaarioon onnistuneesti.')
                        ->success()
                        ->send();
                })
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(scenario_characters::query())
            ->columns([
                TextColumn::make('characters.name')
                    ->label('Hahmo'),
                TextColumn::make('scenarios.name')
                    ->label('Skenaario'),
            ])
            ->actions([
                ActionGroup::make([
                    TableAction::make('edit')
                        ->name('Muokkaa')
                        ->icon('heroicon-o-pencil')
                        ->color('primary')
                        ->fillForm(fn (scenario_characters $record): array => [
                            'character_id' => $record->character_id,
                            'scenario_id' => $record->scenario_id,
                        ])
                        ->form([
                            Select::make('character_id')
                                ->label('Hahmo')
                                ->required()
                                ->searchable()
                                ->options(characters::all()->pluck('name', 'id')->toArray()),
                            Select::make('scenario_id')
                                ->label('Skenaario')
                                ->required()
                                ->searchable()
                                ->options(Scenario::all()->pluck('name', 'id')->toArray())
                        ])
                        ->action(function (array $data, scenario_characters $record): void {
                            $record->update($data);

                            Notification::make()
                                ->title('Kutsukoodi päivitetty')
                                ->body('Kutsukoodi on päivitetty onnistuneesti.')
                                ->success()
                                ->send();
                        }),
                    TableAction::make('delete')
                        ->name('Poista')
                        ->action(fn (scenario_characters $record) => $record->delete())
                        ->requiresConfirmation()
                        ->modalHeading('Poista liitos')
                        ->modalDescription('Haluatko varmasti poistaa liitoksen?')
                        ->modalSubmitActionLabel('Kyllä, poista liitos')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                ])
            ])
            ->emptyStateHeading('Ei hahmoja');
    }
}
