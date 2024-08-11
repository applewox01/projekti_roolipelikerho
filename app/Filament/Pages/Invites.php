<?php

namespace App\Filament\Pages;

use App\Models\InviteCode;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\ActionGroup;

class Invites extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Kutsukoodit';
    protected static ?string $title = 'Kutsukoodit';
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static string $view = 'filament.pages.invites';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->name('Luo kutsukoodi')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->outlined(true)
                ->fillForm(fn (): array => [
                    'code' => Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4)
                ])
                ->form([
                    TextInput::make('code')
                        ->label('Koodi')
                        ->maxLength(255)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    InviteCode::create($data);

                    activity()
                        ->causedBy(auth()->user())
                        ->event('invite_code.created')
                        ->log('Ylläpitäjä ' . auth()->user()->username . ' loi kutsukoodin ' . $data['code']);

                    Notification::make()
                        ->title('Kutsukoodi luotu')
                        ->body('Kutsukoodi on luotu onnistuneesti.')
                        ->success()
                        ->send();
                })
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(InviteCode::query())
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label('Kutsukoodi'),
            ])
            ->actions([
                ActionGroup::make([
                    TableAction::make('edit')
                        ->name('Muokkaa')
                        ->icon('heroicon-o-pencil')
                        ->color('primary')
                        ->fillForm(fn (InviteCode $record): array => [
                            'code' => $record->code,
                        ])
                        ->form([
                            TextInput::make('code')
                                ->label('Koodi')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->action(function (array $data, InviteCode $record): void {
                            $record->code = $data['code'];
                            $record->save();

                            Notification::make()
                                ->title('Kutsukoodi päivitetty')
                                ->body('Kutsukoodi on päivitetty onnistuneesti.')
                                ->success()
                                ->send();
                        }),
                    TableAction::make('delete')
                        ->name('Poista')
                        ->action(function (InviteCode $record) {

                            activity()
                                ->causedBy(auth()->user())
                                ->event('invite_code.deleted')
                                ->log('Ylläpitäjä ' . auth()->user()->username . ' poisti kutsukoodin ' . $record->code);

                            $record->delete();
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Poista kutsukoodi')
                        ->modalDescription('Haluatko varmasti poistaa kutsukoodin?')
                        ->modalSubmitActionLabel('Kyllä, poista kutsukoodi')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                ])
            ])
            ->emptyStateHeading('Ei kutsukoodeja');
    }
}
