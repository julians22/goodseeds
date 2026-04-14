<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\SuccessResource\Pages\ListSuccesses;
use App\Filament\Resources\SuccessResource\Pages\CreateSuccess;
use App\Filament\Resources\SuccessResource\Pages\EditSuccess;
use App\Models\Success;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Table;

class SuccessResource extends Resource
{
    protected static ?string $model = Success::class;
    public static ?string $label = 'Success Story';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Meta')
                    ->schema([
                        TextInput::make('meta.title.en')
                            ->label('English Meta Title')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('meta.title.id')
                            ->label('Bahasa Meta Title')
                            ->maxLength(255),
                        Textarea::make('meta.description.en')
                            ->label('English Meta Description')
                            ->maxLength(255)
                            ->required(),
                        Textarea::make('meta.description.id')
                            ->label('Bahasa Meta Description')
                            ->maxLength(255),
                        TagsInput::make('meta.keywords.en')
                            ->label('EN Keywords')
                            ->placeholder('Ketik lalu tekan Enter'),
                        TagsInput::make('meta.keywords.id')
                            ->label('ID Keywords')
                            ->placeholder('Ketik lalu tekan Enter'),
                    ])
                    ->columns(2),

                Fieldset::make('Title')
                    ->schema([
                        Textarea::make('title.en')
                            ->label('English Title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('title.id')
                            ->label('Bahasa Title')
                            ->maxLength(255),
                    ])
                ->columns(2),

                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->collection('thumbnail')
                    ->image()
                    ->columnSpan(1),

                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->label('Gambar Utama')
                    ->collection('featured_image')
                    ->image()
                    ->columnSpan(2)
                    ->required(),

                Fieldset::make('Content')
                    ->schema([
                        RichEditor::make('content.en')
                            ->label('English Content')
                            ->required(),
                        RichEditor::make('content.id')
                            ->label('Bahasa Content')
                    ])
                    ->columns(1),

                Fieldset::make('Excerpt')
                    ->schema([
                        TextInput::make('excerpt.en')
                            ->label('English Excerpt')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('excerpt.id')
                            ->label('Bahasa Excerpt')
                            ->required()
                            ->maxLength(255),
                    ])
                ->columns(2),

                DatePicker::make('success_date')
                    ->label('Upload Date')
                    ->required()
                    ->maxDate(now())
                    ->minDate(now()->subYears(5))
                    ->placeholder('Select a date'),

                Toggle::make('is_published')
                    ->label('Is Published')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('success_date')
                    ->label('Success Date')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),
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
            'index' => ListSuccesses::route('/'),
            'create' => CreateSuccess::route('/create'),
            'edit' => EditSuccess::route('/{record}/edit'),
        ];
    }
}
