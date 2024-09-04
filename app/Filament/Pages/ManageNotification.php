<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageNotification extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSetting::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Repeater::make('notificationRecipients')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->helperText('Email address of the recipient')
                            ->label('Email')
                            ->email()
                            ->placeholder('Email Recipient')
                            ->required(),
                    ])
                    ->minItems(1)
                    ->maxItems(3),
            ]);
    }
}
