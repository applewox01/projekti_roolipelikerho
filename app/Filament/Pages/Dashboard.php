<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsWidget;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
class Dashboard extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $recordTitleAttribute = 'Hallintapaneeli';
    protected static ?string $navigationLabel = 'Hallintapaneeli';
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static string $view = 'filament.pages.dashboard';

    public function getTitle(): string | Htmlable
    {
        return __('Tervetuloa takaisin ' . Auth::user()->username . '! 👋');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsWidget::class
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('username')
                    ->label('Käyttäjänimi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Sähköposti')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Rekisteröitynyt')
                    ->dateTime()
                    ->since()
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                Action::make('delete')
                    ->label('Poista Käyttäjä')
                    ->requiresConfirmation()
                    ->action(function (User $user) {
                        $user->delete();
                    })
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ]);
    }
}
