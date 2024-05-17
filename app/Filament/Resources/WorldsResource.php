<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorldsResource\Pages;
use App\Models\worlds;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class WorldsResource extends Resource
{
    protected static ?string $model = worlds::class;

    protected ?string $heading = 'Skenaario Maailmat';
    protected ?string $subheading = 'Skenaario Maailmat';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Skenaario Maailmat';
    protected static ?string $title = 'Skenaario Maailmat';

    protected static ?string $navigationParentItem = 'Skenaariot';

    public function getTitle(): string | Htmlable
    {
        return __('Maailmat');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Ei maailmoja');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorlds::route('/'),
            'create' => Pages\CreateWorlds::route('/create'),
            'edit' => Pages\EditWorlds::route('/{record}/edit'),
        ];
    }
}
