<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\TeamResource\Pages\ListTeams;
use App\Filament\Resources\TeamResource\Pages\CreateTeam;
use App\Filament\Resources\TeamResource\Pages\EditTeam;
use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->helperText('The name of the team member')
                    ->required(),
                Fieldset::make('description')
                    ->label('Description')
                    ->schema([
                        RichEditor::make('description.en')
                            ->label('English Description')
                            ->required(),
                        RichEditor::make('description.id')
                            ->label('Bahasa Description'),
                    ])
                    ->columns(2),
                FileUpload::make('image')
                    ->helperText('Recommended size: 520 x 693px (3 : 4), format: JPG, PNG')
                    ->image()
                    ->required()
                    ->disk('team'),
                // Reperater for socials
                // Socialsare options to add social media links, linkedin & Instagram only
                Section::make('Socials')
                    ->description('Add social media links for the team member')
                    ->schema([
                        Repeater::make('socials')
                            ->schema([
                                Select::make('platform')
                                    ->options([
                                        'linkedin' => 'LinkedIn',
                                        'instagram' => 'Instagram',
                                    ])
                                    ->helperText('The social media platform, only LinkedIn and Instagram are supported')
                                    ->required(),
                                TextInput::make('url')
                                    ->helperText('The URL of the social media profile')
                                    ->required(),
                                ]),
                            ]),
                Section::make('Certificates')
                ->description('Upload certificates related to this team member')
                ->schema([
                    Repeater::make('certificate')
                        ->schema([
                            FileUpload::make('file')
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
                TextColumn::make('name')
                    ->searchable(),
                ImageColumn::make('image')
                    ->disk('team')
                    ->circular()
                    ->width('100px')
                    ->height('100px')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}
