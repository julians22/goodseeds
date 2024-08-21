<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApproachResource\Pages;
use App\Filament\Resources\ApproachResource\RelationManagers;
use App\Models\Approach;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Str;

class ApproachResource extends Resource
{
    protected static ?string $model = Approach::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Approach Section Management';

    protected static ?string $label = 'Approach Items';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),
                Forms\Components\FileUpload::make('icon')
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->formatStateUsing(function ($state) {
                        return Str::limit($state, 50);
                    }),
                Tables\Columns\ImageColumn::make('icon')
                    ->disk('approach')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListApproaches::route('/'),
            'create' => Pages\CreateApproach::route('/create'),
            'edit' => Pages\EditApproach::route('/{record}/edit'),
        ];
    }
}
