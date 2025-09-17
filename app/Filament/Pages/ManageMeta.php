<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Fieldset;
use Filament\Notifications\Notification;

use App\Models\HomePages;
use App\Models\ArticlesPages;
use App\Models\SuccessPages;
use App\Models\ServicesPages;

class ManageMeta extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Manage Meta';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-meta';

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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Meta')
                    ->tabs([
                        Tab::make('Home Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('home.meta_title.en')->label('EN Title'),
                                        Forms\Components\TextInput::make('home.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        Forms\Components\TextInput::make('home.meta_description.en')->label('EN Description'),
                                        Forms\Components\TextInput::make('home.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        Forms\Components\TagsInput::make('home.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        Forms\Components\TagsInput::make('home.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                        Tab::make('Insight Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('articles.meta_title.en')->label('EN Title'),
                                        Forms\Components\TextInput::make('articles.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        Forms\Components\TextInput::make('articles.meta_description.en')->label('EN Description'),
                                        Forms\Components\TextInput::make('articles.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        Forms\Components\TagsInput::make('articles.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        Forms\Components\TagsInput::make('articles.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                        Tab::make('Success Story Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('success.meta_title.en')->label('EN Title'),
                                        Forms\Components\TextInput::make('success.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        Forms\Components\TextInput::make('success.meta_description.en')->label('EN Description'),
                                        Forms\Components\TextInput::make('success.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        Forms\Components\TagsInput::make('success.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        Forms\Components\TagsInput::make('success.meta_keywords.id')
                                            ->label('ID Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                    ]),
                            ]),
                        Tab::make('Services Page')
                            ->schema([
                                Fieldset::make('Meta Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('services.meta_title.en')->label('EN Title'),
                                        Forms\Components\TextInput::make('services.meta_title.id')->label('ID Title'),
                                    ]),
                                Fieldset::make('Meta Description')
                                    ->schema([
                                        Forms\Components\TextInput::make('services.meta_description.en')->label('EN Description'),
                                        Forms\Components\TextInput::make('services.meta_description.id')->label('ID Description'),
                                    ]),
                                Fieldset::make('Meta Keywords')
                                    ->schema([
                                        Forms\Components\TagsInput::make('services.meta_keywords.en')
                                            ->label('EN Keywords')
                                            ->placeholder('Ketik lalu tekan Enter'),
                                        Forms\Components\TagsInput::make('services.meta_keywords.id')
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
