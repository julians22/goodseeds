<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->helperText('The name of the team member')
                    ->required(),
                Forms\Components\Fieldset::make('description')
                    ->label('Description')
                    ->schema([
                        Forms\Components\RichEditor::make('description.en')
                            ->label('English Description')
                            ->required(),
                        Forms\Components\RichEditor::make('description.id')
                            ->label('Bahasa Description')
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\FileUpload::make('image')
                    ->helperText('Recommended size: 500 x 500 pixels, format: JPG, PNG')
                    ->image()
                    ->required()
                    ->disk('team'),
                // Reperater for socials
                // Socialsare options to add social media links, linkedin & Instagram only
                Forms\Components\Section::make('Socials')
                    ->description('Add social media links for the team member')
                    ->schema([
                        Forms\Components\Repeater::make('socials')
                            ->schema([
                                Forms\Components\Select::make('platform')
                                    ->options([
                                        'linkedin' => 'LinkedIn',
                                        'instagram' => 'Instagram',
                                    ])
                                    ->helperText('The social media platform, only LinkedIn and Instagram are supported')
                                    ->required(),
                                Forms\Components\TextInput::make('url')
                                    ->helperText('The URL of the social media profile')
                                    ->required(),
                                ]),
                            ]),
                Forms\Components\Section::make('Certificates')
                ->description('Upload certificates related to this team member')
                ->schema([
                    Forms\Components\Repeater::make('certificate')
                        ->schema([
                            Forms\Components\FileUpload::make('file')
                                ->label('Certificate File')
                                ->helperText('Recommended size: 500 x 500 pixels, Upload certificate image (JPG, PNG, PDF)')
                                ->image() 
                                ->avatar()
                                ->directory('certificates')
                                ->nullable(),
                        ])
                        ->collapsible()
                        ->defaultItems(0),
                ])
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('team')
                    ->circular()
                    ->width('100px')
                    ->height('100px')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
