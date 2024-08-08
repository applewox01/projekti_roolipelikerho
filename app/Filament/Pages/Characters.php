<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\characters as ModelsCharacters;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\ActionGroup;

class Characters extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Hahmojen hallinta';
    protected static ?string $title = 'Hahmojen hallinta';
    protected static ?string $navigationIcon = 'fas-hat-wizard';

    protected static ?string $navigationGroup = 'Hahmot';

    protected static string $view = 'filament.pages.characters';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->name('Luo hahmo')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->outlined(true)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->label('Nimi')
                        ->maxLength(255),
                    TextInput::make('race')
                        ->required()
                        ->label('Rotu')
                        ->maxLength(255),
                    TextInput::make('level')
                        ->required()
                        ->label('Taso')
                        ->numeric(),
                    TextInput::make('class')
                        ->maxLength(255)
                        ->label('Luokka'),
                    TextInput::make('player_name')
                        ->maxLength(255)
                        ->label('Pelaajan nimi'),
                    TextInput::make('notes')
                        ->maxLength(255)
                        ->label('Muistiinpanot'),
                ])
                ->action(function (array $data): void {
                    ModelsCharacters::create($data);

                    Notification::make()
                        ->title('Hahmo luotu')
                        ->body('Hahmo on luotu onnistuneesti.')
                        ->success()
                        ->send();
                })
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsCharacters::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nimi'),
                TextColumn::make('race')
                    ->searchable()
                    ->sortable()
                    ->label('Rotu'),
                TextColumn::make('level')
                    ->numeric()
                    ->sortable()
                    ->label('Taso'),
                TextColumn::make('class')
                    ->searchable()
                    ->sortable()
                    ->label('Luokka'),
                TextColumn::make('player_name')
                    ->searchable()
                    ->sortable()
                    ->label('Pelaajan nimi'),
                TextColumn::make('notes')
                    ->searchable()
                    ->sortable()
                    ->label('Muistiinpanot'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Luotu'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Päivitetty'),
            ])
            ->actions([
                ActionGroup::make([
                    TableAction::make('edit')
                        ->name('Muokkaa')
                        ->icon('heroicon-o-pencil')
                        ->color('primary')
                        ->fillForm(fn (ModelsCharacters $record): array => [
                            'name' => $record->name,
                            'race' => $record->race,
                            'level' => $record->level,
                            'class'=> $record->class,
                            'player_name' => $record->player_name,
                            'notes' => $record->notes,
                        ])
                        ->form([
                            TextInput::make('name')
                                ->required()
                                ->label('Nimi')
                                ->maxLength(255),
                            TextInput::make('race')
                                ->required()
                                ->label('Rotu')
                                ->maxLength(255),
                            TextInput::make('level')
                                ->required()
                                ->label('Taso')
                                ->numeric(),
                            TextInput::make('class')
                                ->maxLength(255)
                                ->label('Luokka'),
                            TextInput::make('player_name')
                                ->maxLength(255)
                                ->label('Pelaajan nimi'),
                            TextInput::make('notes')
                                ->maxLength(255)
                                ->label('Muistiinpanot'),
                        ])
                        ->action(function (array $data, ModelsCharacters $record): void {
                            $record->update($data);

                            Notification::make()
                                ->title('Hahmo päivitetty')
                                ->body('Hahmo on päivitetty onnistuneesti.')
                                ->success()
                                ->send();
                        }),
                    TableAction::make('delete')
                        ->name('Poista')
                        ->action(fn (ModelsCharacters $record) => $record->delete())
                        ->requiresConfirmation()
                        ->modalHeading('Poista hahmo')
                        ->modalDescription('Haluatko varmasti poistaa hahmon?')
                        ->modalSubmitActionLabel('Kyllä, poista hahmo')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                ])
            ])
            ->emptyStateHeading('Ei hahmoja');
    }
}
