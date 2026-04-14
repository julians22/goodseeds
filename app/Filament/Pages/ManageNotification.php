<?php

namespace App\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Pages\SettingsPage;

class ManageNotification extends SettingsPage
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSetting::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('notificationRecipients')
                    ->schema([
                        TextInput::make('email')
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
