<?php

namespace App\Filament\Resources\ProvideResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\ProvideResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvides extends ListRecords
{
    protected static string $resource = ProvideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
