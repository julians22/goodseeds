<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('company'),
                TextColumn::make('phone'),
                TextColumn::make('message')
                    ->formatStateUsing(fn (string $state) => substr($state, 0, 50) . '...'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modal(true)
                    ->modalWidth('2xl')
                    ->form([
                        TextInput::make('name')
                            ->disabled()
                            ->placeholder('Name'),
                        TextInput::make('email'),
                        TextInput::make('company'),
                        TextInput::make('phone'),
                        Textarea::make('message')
                            ->disabled()
                            ->placeholder('Message')
                    ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContacts::route('/'),
        ];
    }
}
