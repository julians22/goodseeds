<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use App\Filament\Resources\ProvideResource\Pages\ListProvides;
use App\Filament\Resources\ProvideResource\Pages\CreateProvide;
use App\Filament\Resources\ProvideResource\Pages\EditProvide;
use App\Filament\Resources\ProvideResource\Pages;
use App\Filament\Resources\ProvideResource\RelationManagers;
use App\Models\Provide;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProvideResource extends Resource
{
    protected static ?string $model = Provide::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Provide Section Management';

    protected static ?string $label = 'Provide Items';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('content')
                    ->helperText('The content of the provide item')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => ListProvides::route('/'),
            'create' => CreateProvide::route('/create'),
            'edit' => EditProvide::route('/{record}/edit'),
        ];
    }
}
