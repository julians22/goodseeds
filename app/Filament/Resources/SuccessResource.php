<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuccessResource\Pages;
use App\Filament\Resources\SuccessResource\RelationManagers;
use App\Models\Success;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use FilamentTiptapEditor\TiptapEditor;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use FilamentTiptapEditor\Enums\TiptapOutput;
use App\Filament\Note\SpecialNoteBlock;

class SuccessResource extends Resource
{
    protected static ?string $model = Success::class;
    public static ?string $label = 'Success Story';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Meta')
                    ->schema([
                        Forms\Components\TextInput::make('meta.title.en')
                            ->label('English Meta Title')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('meta.title.id')
                            ->label('Bahasa Meta Title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta.description.en')
                            ->label('English Meta Description')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\Textarea::make('meta.description.id')
                            ->label('Bahasa Meta Description')
                            ->maxLength(255),
                        Forms\Components\TagsInput::make('meta.keywords.en')
                            ->label('EN Keywords')
                            ->placeholder('Ketik lalu tekan Enter'),
                        Forms\Components\TagsInput::make('meta.keywords.id')
                            ->label('ID Keywords')
                            ->placeholder('Ketik lalu tekan Enter'),
                    ])
                    ->columns(2),

                Forms\Components\Hidden::make('slug'),
                Forms\Components\Hidden::make('slug_en'),
                Forms\Components\Hidden::make('slug_id'),

                Forms\Components\Fieldset::make('Title')
                    ->schema([
                        Forms\Components\Textarea::make('title.en')
                            ->label('English Title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {

                                $slug = Str::slug($state);

                                $set('slug', $slug);
                                $set('slug_en', $slug);
                            })
                            ->maxLength(255),

                        Forms\Components\Textarea::make('title.id')
                            ->label('Bahasa Title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {

                                if (!empty($state)) {
                                    $set('slug_id', Str::slug($state));
                                }
                            })
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

                Forms\Components\Fieldset::make('Content')
                    ->schema([
                        TiptapEditor::make('content.en')
                            ->label('English Content')
                            ->maxContentWidth('5xl')
                            ->profile('default')
                            ->blocks([
                                SpecialNoteBlock::class,
                            ])
                            ->output(TiptapOutput::Json)
                            ->required(),

                        TiptapEditor::make('content.id')
                            ->label('Bahasa Content')
                            ->maxContentWidth('5xl')
                            ->profile('default')
                            ->blocks([
                                SpecialNoteBlock::class,
                            ])
                            ->output(TiptapOutput::Json),
                    ])
                    ->columns(1),

                Forms\Components\Fieldset::make('Excerpt')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt.en')
                            ->label('English Excerpt')
                            ->required(),
                        Forms\Components\Textarea::make('excerpt.id')
                            ->label('Bahasa Excerpt')
                            ->required(),
                    ])
                ->columns(2),

                Forms\Components\DatePicker::make('success_date')
                    ->label('Upload Date')
                    ->required()
                    ->maxDate(now())
                    ->minDate(now()->subYears(5))
                    ->placeholder('Select a date'),

                Forms\Components\Toggle::make('is_published')
                    ->label('Is Published')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('success_date')
                    ->label('Success Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),
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
            'index' => Pages\ListSuccesses::route('/'),
            'create' => Pages\CreateSuccess::route('/create'),
            'edit' => Pages\EditSuccess::route('/{record}/edit'),
        ];
    }
}
