<?php

namespace App\Filament\Pages;

use App\Settings\SectionSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageApproach extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SectionSetting::class;

    protected static ?string $navigationGroup = 'Approach Section Management';

    protected static ?string $navigationLabel = 'Approach Section';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('approachTitle')
                    ->required()
                    ->helperText('The title of the approach item')
                    ->label('Title'),
                Forms\Components\RichEditor::make('approachDescription')
                    ->required()
                    ->helperText('The description of the approach item')
                    ->label('Description'),
            ]);
    }
}
