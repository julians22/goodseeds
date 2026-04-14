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
use App\Filament\Resources\ArticleResource\Pages\ListArticles;
use App\Filament\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)
                    ->schema([
                        Section::make('General Information')
                            ->description('Provide the general information about the article, including title, content, excerpt, and publication details.')
                            ->schema([
                                Fieldset::make('Title')
                                    ->schema([
                                        TextInput::make('title.en')
                                            ->label('English Title')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('title.id')
                                            ->label('Bahasa Title')
                                            ->maxLength(255),
                                    ])
                                ->columns(2),

                                Fieldset::make('Content')
                                    ->schema([
                                        RichEditor::make('content.en')
                                            ->label('English Content')
                                            ->required(),
                                        RichEditor::make('content.id')
                                            ->label('Bahasa Content'),
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
                                            ->maxLength(255),
                                    ])
                                ->columns(2),
                            ])
                            ->columnSpan([
                                'default' => 12,
                                'lg' => 8,
                            ]),
                        Grid::make(1)
                            ->schema([
                                Section::make('Images')
                                    ->description('Upload the thumbnail and featured image for the article.')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('thumbnail')
                                            ->label('Thumbnail')
                                            ->collection('thumbnail')
                                            ->image(),
                                        SpatieMediaLibraryFileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->collection('featured_image')
                                            ->image()
                                            ->required(),
                                    ]),
                                Section::make('Publication Details')
                                    ->description('Configure additional details for the article, such as publication date and status.')
                                    ->schema([
                                        DatePicker::make('article_date')
                                            ->label('Article Date')
                                            ->required(),
                                        Toggle::make('is_published')
                                            ->label('Published')
                                            ->helperText('Toggle to publish or unpublish the article'),
                                    ]),
                                Section::make('SEO Metadata')
                                    ->description('Configure the SEO metadata for this article, including meta title, description, and keywords.')
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
                                    ->collapsible()
                                    ->collapsed(true),

                            ])
                            ->columnSpan([
                                'default' => 12,
                                'lg' => 4,
                            ]),


                    ])
                    ->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                TextColumn::make('article_date')
                    ->label('Article Date')
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
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}
