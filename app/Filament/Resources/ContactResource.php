<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\ViewAction;
use App\Filament\Resources\ContactResource\Pages\ManageContacts;
use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Contact List';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                TextColumn::make('created_at'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make()
                    ->modalWidth('2xl')
                    ->schema([
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
            'index' => ManageContacts::route('/'),
        ];
    }
}
