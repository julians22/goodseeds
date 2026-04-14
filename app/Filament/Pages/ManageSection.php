<?php

namespace App\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use App\Settings\SectionSetting;
use Filament\Forms;
use Filament\Pages\SettingsPage;

class ManageSection extends SettingsPage
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SectionSetting::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Section Settings';

    protected static ?int $navigationSort = 2;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Content')
                    ->schema([
                        Tab::make('About')
                            ->schema([

                                Section::make()
                                    ->label('About')
                                    ->schema([
                                        Fieldset::make('aboutTitle')
                                            ->label('About Title')
                                            ->schema([
                                                Textarea::make('aboutTitle.en')
                                                    ->label('English Title')
                                                    ->required(),
                                                Textarea::make('aboutTitle.id')
                                                    ->label('Bahasa Title'),                                            ])
                                            ->columns(2),

                                        Fieldset::make('aboutDescription')
                                            ->label('About Description')
                                            ->schema([
                                                RichEditor::make('aboutDescription.en')
                                                    ->label('English Description')
                                                    ->required(),
                                                RichEditor::make('aboutDescription.id')
                                                    ->label('Bahasa Description'),                                            ])
                                            ->columns(2),
                                    ]),

                                Section::make()
                                    ->label('About Supports')
                                    ->schema([
                                        Fieldset::make('aboutSupportsTitle')
                                            ->label('About Supports Title')
                                            ->schema([
                                                Textarea::make('aboutSupportsTitle.en')
                                                    ->label('English Title')
                                                    ->required(),
                                                Textarea::make('aboutSupportsTitle.id')
                                                    ->label('Bahasa Title'),
                                            ])
                                            ->columns(2),

                                        Repeater::make('aboutSupportsContent')
                                            ->label('About Supports Content')
                                            ->columns(1)
                                            ->schema([
                                                FileUpload::make('icon')
                                                    ->label('Icon')
                                                    ->disk('public')
                                                    ->directory('icons')
                                                    ->image()
                                                    ->required(),

                                                Fieldset::make('aboutSupportsDescription')
                                                    ->label('About Supports Description')
                                                    ->schema([
                                                        Textarea::make('aboutSupportsDescription.en')
                                                            ->label('English Description')
                                                            ->required(),
                                                        Textarea::make('aboutSupportsDescription.id')
                                                            ->label('Bahasa Description'),
                                                    ])
                                                    ->columns(2),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('Services')
                            ->schema([
                                Fieldset::make('servicesTitle')
                                    ->label('Services Title Homepage')
                                    ->schema([
                                        Textarea::make('servicesTitle.en')
                                            ->label('English Title Homepage')
                                            ->required(),
                                        Textarea::make('servicesTitle.id')
                                            ->label('Bahasa Title Homepage'),
                                    ])
                                    ->columns(2),
                                Fieldset::make('servicesNewTitle')
                                    ->label('Services New Title')
                                    ->schema([
                                        Textarea::make('servicesNewTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Textarea::make('servicesNewTitle.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),

                                Fieldset::make('servicesDescription')
                                    ->label('Services Description')
                                    ->schema([
                                        RichEditor::make('servicesDescription.en')
                                            ->label('English Title')
                                            ->required(),
                                        RichEditor::make('servicesDescription.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Approach')
                            ->schema([
                                FileUpload::make('diagramImage')
                                    ->label('Diagram Image'),
                                FileUpload::make('diagramImageMobile'),
                                Fieldset::make('approachTitle')
                                    ->label('Aproach Title')
                                    ->schema([
                                        Textarea::make('approachTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Textarea::make('approachTitle.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),
                                Fieldset::make('approachDescription')
                                    ->label('Aproach Description')
                                    ->schema([
                                        RichEditor::make('approachDescription.en')
                                            ->label('English Title')
                                            ->required(),
                                        RichEditor::make('approachDescription.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Teams')
                            ->schema([
                                Fieldset::make('teamTitle')
                                    ->label('Teams Title')
                                    ->schema([
                                        TextInput::make('teamTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        TextInput::make('teamTitle.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),
                                Fieldset::make('teamDescription')
                                    ->label('Teams Description')
                                    ->schema([
                                        RichEditor::make('teamDescription.en')
                                            ->label('English Title')
                                            ->required(),
                                        RichEditor::make('teamDescription.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),
                                Fieldset::make('teamSection')
                                    ->label('Team Section')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('teamSection.teamNameLeft')
                                                    ->label('Team Name Left')
                                                    ->required(),
                                                TextInput::make('teamSection.teamNameRight')
                                                    ->label('Team Name Right')
                                                    ->required(),
                                            ]),
                                    FileUpload::make('teamSection.teamImage')
                                        ->label('Team Image')
                                        ->disk('public')
                                        ->directory('team')
                                        ->image(),
                                    ])
                                    ->columns(1),
                                ]),

                        Tab::make('Message')
                            ->schema([
                                Repeater::make('messages')
                                    ->label('Messages')
                                    ->columns(1)
                                    ->schema([

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('messageName')
                                                    ->label('Name')
                                                    ->required(),
                                                TextInput::make('messagePosition')
                                                    ->label('Position')
                                                    ->required(),
                                            ]),

                                        FileUpload::make('messageImage')
                                            ->label('Image')
                                            ->image()
                                            ->disk('public')
                                            ->directory('quotes')
                                            ->required(),

                                        Fieldset::make('messageQuote')
                                            ->label('Message Quote')
                                            ->schema([
                                                RichEditor::make('messageQuote.en')
                                                    ->label('English Quote')
                                                    ->required(),
                                                RichEditor::make('messageQuote.id')
                                                    ->label('Bahasa Quote'),
                                            ])
                                            ->columns(2),

                                    ]),
                            ]),

                        Tab::make('Success Story')
                            ->schema([
                                Fieldset::make('successStoryTitle')
                                    ->label('Success Story Title')
                                    ->schema([
                                        Textarea::make('successStoryTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Textarea::make('successStoryTitle.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),

                                Fieldset::make('successStoryDescription')
                                    ->label('Success Story Description')
                                    ->schema([
                                        RichEditor::make('successStoryDescription.en')
                                            ->label('English Description')
                                            ->required(),
                                        RichEditor::make('successStoryDescription.id')
                                            ->label('Bahasa Description'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Insight')
                            ->schema([
                                Fieldset::make('articleTitle')
                                    ->label('Insight Title')
                                    ->schema([
                                        Textarea::make('articleTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Textarea::make('articleTitle.id')
                                            ->label('Bahasa Title'),
                                    ])
                                    ->columns(2),

                                Fieldset::make('articleDescription')
                                    ->label('Insight Description')
                                    ->schema([
                                        RichEditor::make('articleDescription.en')
                                            ->label('English Description')
                                            ->required(),
                                        RichEditor::make('articleDescription.id')
                                            ->label('Bahasa Description'),
                                    ])
                                    ->columns(2),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
