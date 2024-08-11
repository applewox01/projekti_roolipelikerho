<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;

class Logs extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Lokitiedot';
    protected static ?string $title = 'Lokitiedot';
    protected static ?string $navigationIcon = 'fas-shield-alt';

    protected static ?string $navigationGroup = 'Ylläpito';

    protected static string $view = 'filament.pages.logs';

    public function table(Table $table): Table
    {
        return $table
            ->query(Activity::query()->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('event')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('causer.username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make('view')
                        ->icon('heroicon-o-eye')
                        ->label('View')
                        ->color('success')
                        ->form([
                            TextInput::make('event')
                                ->disabled()
                                ->label('Event'),
                            TextInput::make('causer.username')
                                ->disabled()
                                ->label('Username'),
                            TextInput::make('description')
                                ->disabled()
                                ->label('Description'),
                            DatePicker::make('created_at')
                                ->disabled()
                                ->label('Created At'),
                        ]),
                ]),
            ])
            ->emptyStateHeading('Ei lokitietoja');
    }
}
