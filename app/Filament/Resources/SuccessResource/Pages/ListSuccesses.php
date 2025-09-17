<?php

namespace App\Filament\Resources\SuccessResource\Pages;

use App\Filament\Resources\SuccessResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuccesses extends ListRecords
{
    protected static string $resource = SuccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
