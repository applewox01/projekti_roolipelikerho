<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\characters as ModelsCharacters;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                    FileUpload::make('attachment')
                        ->label('Hahmolomake')
                        ->moveFiles()
                        ->disk('public')
                        ->maxSize(107200)
                        ->uploadingMessage('Ladataan hahmolomaketta...')
                        ->openable()
                        ->hint('Max tiedosto koko: 100MB')
                        ->hintIcon('heroicon-o-information-circle')
                ])
                ->action(function (array $data): void {
                    $attachment = $data['attachment'] ?? null;

                    if ($attachment) {
                        $extension = '.' . pathinfo($attachment, PATHINFO_EXTENSION);
                        $newAttachment = $this->handleUpload($attachment, 'characters', $extension);
                        $data['attachment'] = $newAttachment;
                    }

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
                        ->fillForm(function (ModelsCharacters $record): array {
                            return [
                                'name' => $record->name,
                                'race' => $record->race,
                                'level' => $record->level,
                                'class'=> $record->class,
                                'player_name' => $record->player_name,
                                'notes' => $record->notes,
                                'attachment' => $record->attachment,
                            ];
                        })
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
                            FileUpload::make('attachment')
                                ->label('Hahmolomake')
                                ->moveFiles()
                                ->disk('public')
                                ->maxSize(107200)
                                ->uploadingMessage('Ladataan hahmolomaketta...')
                                ->openable()
                                ->hint('Max tiedosto koko: 100MB')
                                ->hintIcon('heroicon-o-information-circle')
                        ])
                        ->action(function (array $data, ModelsCharacters $record): void {
                            $attachment = $data['attachment'] ?? $record->attachment;

                            if ($attachment) {
                                $extension = '.' . pathinfo($attachment, PATHINFO_EXTENSION);
                                $newAttachment = $this->handleUpload($attachment, 'characters', $extension);
                                $data['attachment'] = $newAttachment;
                            }

                            $record->update($data);

                            Notification::make()
                                ->title('Hahmo päivitetty')
                                ->body('Hahmo on päivitetty onnistuneesti.')
                                ->success()
                                ->send();
                        }),
                    TableAction::make('delete')
                        ->name('Poista')
                        ->action(function (ModelsCharacters $record) {

                            $attachement = $record->attachement;

                            if ($attachement) {
                                Storage::disk('public')->delete($attachement);
                            }

                            $record->delete();
                        })
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

    private function handleUpload($file, $folder, $extension): string {
        $disk = Storage::disk('public');

        if ($disk->exists($file)) {
            $filePath = $file;

            $newFilename = $folder . '/' . Str::random(8) . $extension;

            $fileContents = $disk->get($filePath);

            $disk->put($newFilename, $fileContents);

            $disk->delete($filePath);

            return $newFilename;
        }

        return '';
    }

}
