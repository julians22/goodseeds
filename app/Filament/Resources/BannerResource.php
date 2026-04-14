<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\BannerResource\Pages\ListBanners;
use App\Filament\Resources\BannerResource\Pages\CreateBanner;
use App\Filament\Resources\BannerResource\Pages\EditBanner;
use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use App\Tables\Columns\BannerTextColumn;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Banner Media')
                    ->helperText('Recommended image size: 1395 x 654 pixels, format: JPG, PNG. For video: MP4 only.')
                    // ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'video/mp4'])
                    ->disk('banner')
                    ->directory('banners')
                    ->required(),
                // Forms\Components\Toggle::make('primary_text')
                //     ->label('Primary Text')
                //     ->helperText('If enabled, this banner will be the primary text banner, meaning it will be showed on mobile devices')
                //     ->default(false),
                // // Section titles
                // Forms\Components\Section::make('Banner Titles')
                //     ->description('Add up to 4 words, each with a different color, to be displayed on the banner')
                //     ->schema([
                //         Forms\Components\Repeater::make('titles')
                //             ->schema([
                //                 Forms\Components\TextInput::make('word')
                //                     ->helperText('Enter a word, e.g. "Nurture"')
                //                     ->label('Word'),
                //                 // Word colors
                //                 Forms\Components\ColorPicker::make('color')
                //                     ->helperText('Pick a color for the word')
                //                     ->label('Color'),
                //             ])
                //             ->columnSpanFull()
                //             ->defaultItems(4)
                //             ->maxItems(4),

                //     ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('banner'),
                // Tables\Columns\ToggleColumn::make('primary_text')
                //     ->placeholder('Primary Text')
                //     ->afterStateUpdated(function ($record, $state) {
                //         $exceptBanner = Banner::withoutGlobalScope(SoftDeletingScope::class)->where('id', '!=', $record->id)->get();
                //         $exceptBanner->each(function ($banner) {
                //             $banner->update(['primary_text' => false]);
                //         });
                //     }),
                // BannerTextColumn::make('titles'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
