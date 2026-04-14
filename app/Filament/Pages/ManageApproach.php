<?php

namespace App\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Settings\SectionSetting;
use Filament\Pages\SettingsPage;

class ManageApproach extends SettingsPage
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SectionSetting::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Approach Section Management';

    protected static ?string $navigationLabel = 'Approach Section';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('approachTitle')
                    ->label('Title')
                    ->schema([
                        TextInput::make('approachTitle.en')
                            ->required()
                            ->label('English Title'),
                        TextInput::make('approachTitle.id')
                            ->label('Bahasa Title'),
                    ])
                    ->columns(2),
                Fieldset::make('approachDescription')
                    ->label('Description')
                    ->schema([
                        RichEditor::make('approachDescription.en')
                            ->required()
                            ->label('English Description'),
                        RichEditor::make('approachDescription.id')
                            ->label('Bahasa Description'),
                    ])
                    ->columns(2),
            ]);
    }
}
