<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\worlds as ModelsWorlds;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action as TableAction;

class Worlds extends Page implements HasTable
{
    use InteractsWithTable;

    protected ?string $heading = 'Skenaario Maailmat';
    protected static ?string $navigationLabel = 'Skenaario Maailmat';
    protected static ?string $title = 'Skenaario Maailmat';

    protected static ?string $navigationParentItem = 'Skenaariot';


    protected static string $view = 'filament.pages.worlds';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->name('Uusi Maailma')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->outlined(true)
                ->form([
                    TextInput::make('name')
                        ->label('Nimi')
                        ->required()
                        ->maxLength(255),
                ])
                ->action(function (array $data): void {
                    ModelsWorlds::create($data);

                    Notification::make()
                        ->title('Maailma luotu')
                        ->body('Maailma on luotu onnistuneesti.')
                        ->success()
                        ->send();
                })
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsWorlds::query())
            ->columns([
                TextColumn::make('name')
                    ->label('Nimi')
                    ->searchable()
                    ->sortable()
            ])
            ->actions([
                ActionGroup::make([
                    TableAction::make('edit')
                        ->name('Muokkaa')
                        ->icon('heroicon-o-pencil')
                        ->color('primary')
                        ->fillForm(fn (ModelsWorlds $record): array => [
                            'name' => $record->name,
                        ])
                        ->form([
                            TextInput::make('name')
                                ->label('Nimi')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->action(function (array $data, ModelsWorlds $record): void {
                            $record->name = $data['name'];
                            $record->save();

                            Notification::make()
                                ->title('Maailma päivitetty')
                                ->body('Maailma on päivitetty onnistuneesti.')
                                ->success()
                                ->send();
                        }),
                    TableAction::make('delete')
                        ->name('Poista')
                        ->action(fn (ModelsWorlds $record) => $record->delete())
                        ->requiresConfirmation()
                        ->modalHeading('Poista maailma')
                        ->modalDescription('Haluatko varmasti poistaa maailman?')
                        ->modalSubmitActionLabel('Kyllä, poista maailma')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                ])
            ])
            ->emptyStateHeading('Ei maailmoja');
    }
}
