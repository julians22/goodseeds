<?php

namespace App\Filament\Pages;

use App\Settings\SectionSetting;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;

class ManageSection extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SectionSetting::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Content')
                    ->schema([
                        Tab::make('About')
                            ->schema([
                                Forms\Components\TextInput::make('aboutTitle')
                                    ->label('Title'),
                                TiptapEditor::make('aboutDescription')
                                    ->profile('goodseeds')
                                    ->maxContentWidth('5xl')
                            ]),
                        Tab::make('Services')
                            ->schema([
                                Forms\Components\TextInput::make('servicesTitle')
                                    ->label('Title'),
                            ]),
                        Tab::make('Portfolio')
                            ->schema([
                                Forms\Components\TextInput::make('provideTitle')
                                    ->label('Title'),
                            ]),
                        Tab::make('Diagram')
                            ->schema([
                                Forms\Components\FileUpload::make('diagramImage')
                                    ->label('Diagram Image'),
                                Forms\Components\FileUpload::make('diagramImageMobile')
                            ]),
                        Tab::make('Approach')
                            ->schema([
                                Forms\Components\TextInput::make('approachTitle')
                                    ->label('Title'),
                                Forms\Components\RichEditor::make('approachDescription')
                                    ->label('Description'),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }
}
