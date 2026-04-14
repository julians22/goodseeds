<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use App\Filament\Resources\ApproachResource\Pages\ListApproaches;
use App\Filament\Resources\ApproachResource\Pages\CreateApproach;
use App\Filament\Resources\ApproachResource\Pages\EditApproach;
use App\Filament\Resources\ApproachResource\Pages;
use App\Filament\Resources\ApproachResource\RelationManagers;
use App\Models\Approach;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Str;

class ApproachResource extends Resource
{
    protected static ?string $model = Approach::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Approach Section Management';

    protected static ?string $label = 'Approach Items';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('title')
                    ->label('Title')
                    ->schema([
                        Textarea::make('title.en')
                            ->label('English Title')
                            ->required(),
                        Textarea::make('title.id')
                            ->label('Bahasa Title'),
                    ])
                    ->columns(2),
                Fieldset::make('description')
                    ->label('Description')
                    ->schema([
                        RichEditor::make('description.en')
                            ->label('English Description')
                            ->required(),
                        RichEditor::make('description.id')
                            ->label('Bahasa Description'),
                    ])
                    ->columns(2),
                FileUpload::make('icon')
                    ->helperText('Recommended size: 200 x 200 pixels, format: PNG')
                    ->label('Icon')
                    ->image()
                    ->disk('approach')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->formatStateUsing(function ($state) {
                        return Str::limit($state, 50);
                    }),
                ImageColumn::make('icon')
                    ->disk('approach')
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
            'index' => ListApproaches::route('/'),
            'create' => CreateApproach::route('/create'),
            'edit' => EditApproach::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool{
        return false;
    }
}
