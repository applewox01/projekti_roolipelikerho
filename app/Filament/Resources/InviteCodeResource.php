<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InviteCodeResource\Pages;
use App\Filament\Resources\InviteCodeResource\RelationManagers;
use App\Models\InviteCode;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class InviteCodeResource extends Resource
{
    protected static ?string $model = InviteCode::class;

    protected static ?string $recordTitleAttribute = 'Kutsukoodit';
    protected static ?string $navigationLabel = 'Kutsukoodit';
    protected static ?string $title = 'Kutsukoodit';
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function form(Form $form): Form
    {
        $generatedCode = Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4);
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->default($generatedCode),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->requiresConfirmation(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('Ei kutsukoodeja');
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
            'index' => Pages\ListInviteCodes::route('/'),
            'create' => Pages\CreateInviteCode::route('/create'),
            'edit' => Pages\EditInviteCode::route('/{record}/edit'),
        ];
    }
}
