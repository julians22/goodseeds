<?php

namespace App\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

use App\Models\HomePages;
use App\Models\ArticlesPages;
use App\Models\SuccessPages;
use App\Models\ServicesPages;

class ManageMeta extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | \UnitEnum | null $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Manage Meta';
    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.manage-meta';

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'home'     => HomePages::first()?->toArray() ?? [],
            'articles' => ArticlesPages::first()?->toArray() ?? [],
            'success'  => SuccessPages::first()?->toArray() ?? [],
            'services' => ServicesPages::first()?->toArray() ?? [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Meta')
                    ->tabs([
                        Tab::make('Home Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        TextInput::make('home.meta_title.en')->label('EN Title'),
                                        TextInput::make('home.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        TextInput::make('home.meta_description.en')->label('EN Description'),
                                        TextInput::make('home.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        TagsInput::make('home.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        TagsInput::make('home.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                        Tab::make('Insight Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        TextInput::make('articles.meta_title.en')->label('EN Title'),
                                        TextInput::make('articles.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        TextInput::make('articles.meta_description.en')->label('EN Description'),
                                        TextInput::make('articles.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        TagsInput::make('articles.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        TagsInput::make('articles.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                        Tab::make('Success Story Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        TextInput::make('success.meta_title.en')->label('EN Title'),
                                        TextInput::make('success.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        TextInput::make('success.meta_description.en')->label('EN Description'),
                                        TextInput::make('success.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        TagsInput::make('success.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        TagsInput::make('success.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                        Tab::make('Services Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        TextInput::make('services.meta_title.en')->label('EN Title'),
                                        TextInput::make('services.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        TextInput::make('services.meta_description.en')->label('EN Description'),
                                        TextInput::make('services.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        TagsInput::make('services.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        TagsInput::make('services.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        HomePages::updateOrCreate(['id' => 1], $this->data['home'] ?? []);
        ArticlesPages::updateOrCreate(['id' => 1], $this->data['articles'] ?? []);
        SuccessPages::updateOrCreate(['id' => 1], $this->data['success'] ?? []);
        ServicesPages::updateOrCreate(['id' => 1], $this->data['services'] ?? []);

        Notification::make()
            ->success()
            ->title('Saved')
            ->body('Meta settings saved successfully!')
            ->send();
    }

}
