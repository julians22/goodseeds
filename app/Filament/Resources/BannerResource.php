<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use App\Tables\Columns\BannerTextColumn;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('banner')
                    ->required(),
                Forms\Components\Toggle::make('primary_text'),
                Forms\Components\Repeater::make('titles')
                    ->schema([
                        Forms\Components\TextInput::make('word')
                            ->label('Word')
                            ->required(),
                        // Word colors
                        Forms\Components\ColorPicker::make('color')
                            ->label('Color')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->defaultItems(4)
                    ->maxItems(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('banner'),
                Tables\Columns\ToggleColumn::make('primary_text')
                    ->placeholder('Primary Text')
                    ->afterStateUpdated(function ($record, $state) {
                        $exceptBanner = Banner::withoutGlobalScope(SoftDeletingScope::class)->where('id', '!=', $record->id)->get();
                        $exceptBanner->each(function ($banner) {
                            $banner->update(['primary_text' => false]);
                        });
                    }),
                BannerTextColumn::make('titles'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
