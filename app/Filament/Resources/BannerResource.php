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

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Banner Image')
                    ->helperText('Recommended size: 1395 x 654 pixels, format: JPG, PNG')
                    ->image()
                    ->disk('banner')
                    ->required(),
                Forms\Components\Toggle::make('primary_text')
                    ->label('Primary Text')
                    ->helperText('If enabled, this banner will be the primary text banner, meaning it will be showed on mobile devices')
                    ->default(false),
                // Section titles
                Forms\Components\Section::make('Banner Titles')
                    ->description('Add up to 4 words, each with a different color, to be displayed on the banner')
                    ->schema([
                        Forms\Components\Repeater::make('titles')
                            ->schema([
                                Forms\Components\TextInput::make('word')
                                    ->helperText('Enter a word, e.g. "Nurture"')
                                    ->label('Word')
                                    ->required(),
                                // Word colors
                                Forms\Components\ColorPicker::make('color')
                                    ->helperText('Pick a color for the word')
                                    ->label('Color')
                                    ->required(),
                            ])
                            ->columnSpanFull()
                            ->defaultItems(4)
                            ->maxItems(4),

                    ])

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
