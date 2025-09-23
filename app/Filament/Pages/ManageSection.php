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

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Section Settings';

    protected static ?int $navigationSort = 2;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Content')
                    ->schema([
                        Tab::make('About')
                            ->schema([

                                Forms\Components\Section::make()
                                    ->label('About')
                                    ->schema([
                                        Forms\Components\Fieldset::make('aboutTitle')
                                            ->label('About Title')
                                            ->schema([
                                                Forms\Components\Textarea::make('aboutTitle.en')
                                                    ->label('English Title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('aboutTitle.id')
                                                    ->label('Bahasa Title')
                                                    ->required(),
                                            ])
                                            ->columns(2),

                                        Forms\Components\Fieldset::make('aboutDescription')
                                            ->label('About Description')
                                            ->schema([
                                                TiptapEditor::make('aboutDescription.en')
                                                    ->label('English Description')
                                                    ->required(),
                                                TiptapEditor::make('aboutDescription.id')
                                                    ->label('Bahasa Description')
                                                    ->required(),
                                            ])
                                            ->columns(2),
                                    ]),

                                Forms\Components\Section::make()
                                    ->label('About Supports')
                                    ->schema([
                                        Forms\Components\Fieldset::make('aboutSupportsTitle')
                                            ->label('About Supports Title')
                                            ->schema([
                                                Forms\Components\Textarea::make('aboutSupportsTitle.en')
                                                    ->label('English Title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('aboutSupportsTitle.id')
                                                    ->label('Bahasa Title')
                                                    ->required(),
                                            ])
                                            ->columns(2),

                                        Forms\Components\Repeater::make('aboutSupportsContent')
                                            ->label('About Supports Content')
                                            ->columns(1)
                                            ->schema([
                                                Forms\Components\FileUpload::make('icon')
                                                    ->label('Icon')
                                                    ->disk('public')
                                                    ->directory('icons')
                                                    ->image()
                                                    ->required(),

                                                Forms\Components\Fieldset::make('aboutSupportsDescription')
                                                    ->label('About Supports Description')
                                                    ->schema([
                                                        Forms\Components\Textarea::make('aboutSupportsDescription.en')
                                                            ->label('English Description')
                                                            ->required(),
                                                        Forms\Components\Textarea::make('aboutSupportsDescription.id')
                                                            ->label('Bahasa Description')
                                                            ->required(),
                                                    ])
                                                    ->columns(2),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('Services')
                            ->schema([
                                Forms\Components\Fieldset::make('servicesTitle')
                                    ->label('Services Title Homepage')
                                    ->schema([
                                        Forms\Components\Textarea::make('servicesTitle.en')
                                            ->label('English Title Homepage')
                                            ->required(),
                                        Forms\Components\Textarea::make('servicesTitle.id')
                                            ->label('Bahasa Title Homepage')
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Forms\Components\Fieldset::make('servicesNewTitle')
                                    ->label('Services New Title')
                                    ->schema([
                                        Forms\Components\Textarea::make('servicesNewTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\Textarea::make('servicesNewTitle.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),

                                Forms\Components\Fieldset::make('servicesDescription')
                                    ->label('Services Description')
                                    ->schema([
                                        Forms\Components\RichEditor::make('servicesDescription.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\RichEditor::make('servicesDescription.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Approach')
                            ->schema([
                                Forms\Components\FileUpload::make('diagramImage')
                                    ->label('Diagram Image'),
                                Forms\Components\FileUpload::make('diagramImageMobile'),
                                Forms\Components\Fieldset::make('approachTitle')
                                    ->label('Aproach Title')
                                    ->schema([
                                        Forms\Components\Textarea::make('approachTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\Textarea::make('approachTitle.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Forms\Components\Fieldset::make('approachDescription')
                                    ->label('Aproach Description')
                                    ->schema([
                                        Forms\Components\RichEditor::make('approachDescription.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\RichEditor::make('approachDescription.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Teams')
                            ->schema([
                                Forms\Components\Fieldset::make('teamTitle')
                                    ->label('Teams Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('teamTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\TextInput::make('teamTitle.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Forms\Components\Fieldset::make('teamDescription')
                                    ->label('Teams Description')
                                    ->schema([
                                        Forms\Components\RichEditor::make('teamDescription.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\RichEditor::make('teamDescription.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Forms\Components\Fieldset::make('teamSection')
                                    ->label('Team Section')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('teamSection.teamNameLeft')
                                                    ->label('Team Name Left')
                                                    ->required(),
                                                Forms\Components\TextInput::make('teamSection.teamNameRight')
                                                    ->label('Team Name Right')
                                                    ->required(),
                                            ]),
                                    Forms\Components\FileUpload::make('teamSection.teamImage')
                                        ->label('Team Image')
                                        ->disk('public')
                                        ->directory('team')
                                        ->image(),
                                    ])
                                    ->columns(1),
                                ]),

                        Tab::make('Message')
                            ->schema([
                                Forms\Components\Repeater::make('messages')
                                    ->label('Messages')
                                    ->columns(1)
                                    ->schema([

                                        Forms\Components\Grid::make(2) // Name & Position sejajar
                                            ->schema([
                                                Forms\Components\TextInput::make('messageName')
                                                    ->label('Name')
                                                    ->required(),
                                                Forms\Components\TextInput::make('messagePosition')
                                                    ->label('Position')
                                                    ->required(),
                                            ]),

                                        Forms\Components\FileUpload::make('messageImage') // Image full width
                                            ->label('Image')
                                            ->image()
                                            ->disk('public')
                                            ->directory('quotes') // lowercase lebih aman
                                            ->required(),

                                        Forms\Components\Fieldset::make('messageQuote') // Quote fieldset
                                            ->label('Message Quote')
                                            ->schema([
                                                Forms\Components\RichEditor::make('messageQuote.en')
                                                    ->label('English Quote')
                                                    ->required(),
                                                Forms\Components\RichEditor::make('messageQuote.id')
                                                    ->label('Bahasa Quote')
                                                    ->required(),
                                            ])
                                            ->columns(2),

                                    ]),
                            ]),

                        Tab::make('Success Story')
                            ->schema([
                                Forms\Components\Fieldset::make('successStoryTitle')
                                    ->label('Success Story Title')
                                    ->schema([
                                        Forms\Components\Textarea::make('successStoryTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\Textarea::make('successStoryTitle.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),

                                Forms\Components\Fieldset::make('successStoryDescription')
                                    ->label('Success Story Description')
                                    ->schema([
                                        Forms\Components\RichEditor::make('successStoryDescription.en')
                                            ->label('English Description')
                                            ->required(),
                                        Forms\Components\RichEditor::make('successStoryDescription.id')
                                            ->label('Bahasa Description')
                                            ->required(),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Insight')
                            ->schema([
                                Forms\Components\Fieldset::make('articleTitle')
                                    ->label('Insight Title')
                                    ->schema([
                                        Forms\Components\Textarea::make('articleTitle.en')
                                            ->label('English Title')
                                            ->required(),
                                        Forms\Components\Textarea::make('articleTitle.id')
                                            ->label('Bahasa Title')
                                            ->required(),
                                    ])
                                    ->columns(2),

                                Forms\Components\Fieldset::make('articleDescription')
                                    ->label('Insight Description')
                                    ->schema([
                                        Forms\Components\RichEditor::make('articleDescription.en')
                                            ->label('English Description')
                                            ->required(),
                                        Forms\Components\RichEditor::make('articleDescription.id')
                                            ->label('Bahasa Description')
                                            ->required(),
                                    ])
                                    ->columns(2),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
