<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSite extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSetting::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                ->columns(12)
                ->schema([
                    Section::make('Site Information')
                        ->columns(1)
                        ->schema([
                            TextInput::make('siteTitle')
                                ->required(),
                            Textarea::make('siteAddress')
                                ->required(),
                            FileUpload::make('headerLogo')
                                ->image()
                                ->disk('public')
                                ->required(),
                            FileUpload::make('footerLogo')
                                ->image()
                                ->disk('public')
                                ->required(),
                            // Repeatble Social Media Links
                            Repeater::make('socialMediaLinks')
                                ->schema([
                                    Select::make('role')
                                        ->options([
                                            'linkedin' => 'Linkedin',
                                            'instagram' => 'Instagram',
                                            'facebook' => 'Facebook',
                                            'twitter' => 'Twitter',
                                            ])
                                        ->required(),
                                    TextInput::make('link')->required(),
                                    ]),
                        ]),
                ])
            ]);
    }
}
