<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use App\Filament\Resources\ServiceResource\Pages\ListServices;
use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
        protected static string | \UnitEnum | null $navigationGroup = 'Pages Management';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    // perpage
    public static int $perPage = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->helperText('The name of the service')
                    ->label('Service Name')
                    ->required(),
                Fieldset::make('description')
                    ->schema([
                        RichEditor::make('description.en')
                            ->label('English Description')
                            ->required(),
                        RichEditor::make('description.id')
                            ->label('Bahasa Description'),
                    ])
                    ->columns(1),
                FileUpload::make('image')
                    ->helperText('Recommended size: 497 x 268 pixels, format: JPG, PNG')
                    ->label('Service Image')
                    ->image()
                    ->disk('service')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                ImageColumn::make('image')
                    ->disk('service'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([

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
            'index' => ListServices::route('/'),
            // 'create' => Pages\CreateService::route('/create'),
            // 'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool{
        return true;
    }
}
