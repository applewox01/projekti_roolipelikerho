<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharactersResource\Pages;
use App\Filament\Resources\CharactersResource\RelationManagers;
use App\Models\Characters;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharactersResource extends Resource
{
    protected static ?string $model = Characters::class;

    protected static ?string $recordTitleAttribute = 'Hahmojen hallinta';
    protected static ?string $navigationLabel = 'Hahmojen hallinta';
    protected static ?string $title = 'Hahmojen hallinta';
    protected static ?string $navigationIcon = 'fas-hat-wizard';

    protected static ?string $navigationGroup = 'Hahmot';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nimi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('race')
                    ->required()
                    ->label('Rotu')
                    ->maxLength(255),
                Forms\Components\TextInput::make('level')
                    ->required()
                    ->label('Taso')
                    ->numeric(),
                Forms\Components\TextInput::make('class')
                    ->maxLength(255)
                    ->label('Luokka'),
                Forms\Components\TextInput::make('player_name')
                    ->maxLength(255)
                    ->label('Pelaajan nimi'),
                Forms\Components\TextInput::make('notes')
                    ->maxLength(255)
                    ->label('Muistiinpanot'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nimi'),
                Tables\Columns\TextColumn::make('race')
                    ->searchable()
                    ->sortable()
                    ->label('Rotu'),
                Tables\Columns\TextColumn::make('level')
                    ->numeric()
                    ->sortable()
                    ->label('Taso'),
                Tables\Columns\TextColumn::make('class')
                    ->searchable()
                    ->sortable()
                    ->label('Luokka'),
                Tables\Columns\TextColumn::make('player_name')
                    ->searchable()
                    ->sortable()
                    ->label('Pelaajan nimi'),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable()
                    ->sortable()
                    ->label('Muistiinpanot'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Luotu'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Päivitetty'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacters::route('/create'),
            'edit' => Pages\EditCharacters::route('/{record}/edit'),
        ];
    }
}
