<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use FilamentTiptapEditor\TiptapEditor;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Fieldset::make('Title')
                    ->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->label('English Title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title.id')
                            ->label('Bahasa Title')
                            ->required()
                            ->maxLength(255),
                    ])
                ->columns(2),

                Forms\Components\Fieldset::make('Content')
                    ->schema([
                        TiptapEditor::make('content.en')
                            ->label('English Content')
                            ->maxContentWidth('5xl')
                            ->required(),
                        TiptapEditor::make('content.id')
                            ->label('Bahasa Content')
                            ->maxContentWidth('5xl')
                            ->required(),
                    ])
                    ->columns(1),

                Forms\Components\Fieldset::make('Meta Title')
                    ->schema([
                        Forms\Components\TextInput::make('meta.title.en')
                            ->label('English Meta Title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('meta.title.id')
                            ->label('Bahasa Meta Title')
                            ->required()
                            ->maxLength(255),
                    ])
                ->columns(2),

                Forms\Components\Fieldset::make('Excerpt')
                    ->schema([
                        Forms\Components\TextInput::make('excerpt.en')
                            ->label('English Excerpt')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('excerpt.id')
                            ->label('Bahasa Excerpt')
                            ->required()
                            ->maxLength(255),
                    ])
                ->columns(2),

                Forms\Components\DatePicker::make('article_date')
                    ->label('Article Date')
                    ->required()
                    ->maxDate(now())
                    ->minDate(now()->subYears(5))
                    ->placeholder('Select a date'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
