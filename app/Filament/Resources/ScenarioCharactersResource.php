<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScenarioCharactersResource\Pages;
use App\Filament\Resources\ScenarioCharactersResource\RelationManagers;
use App\Models\characters;
use App\Models\Scenario;
use App\Models\scenario_characters;
use App\Models\ScenarioCharacters;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScenarioCharactersResource extends Resource
{
    protected static ?string $model = scenario_characters::class;

    protected ?string $heading = 'Skenaariohahmojen hallinta';
    protected ?string $subheading = 'Skenaariohahmojen hallinta';
    protected static ?string $recordTitleAttribute = 'Skenaariohahmojen hallinta';
    protected static ?string $navigationLabel = 'Skenaariohahmojen hallinta';
    protected static ?string $title = 'Skenaariohahmojen hallinta';

    protected static ?string $navigationParentItem = 'Hahmojen hallinta';

    protected static ?string $navigationGroup = 'Hahmot';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('characters.name')
                    ->label('Hahmo'),
                TextColumn::make('scenarios.name')
                    ->label('Skenaario'),
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
            ])
            ->emptyStateHeading('Ei hahmoja');
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
            'index' => Pages\ListScenarioCharacters::route('/'),
            'create' => Pages\CreateScenarioCharacters::route('/create'),
            'edit' => Pages\EditScenarioCharacters::route('/{record}/edit'),
        ];
    }
}
