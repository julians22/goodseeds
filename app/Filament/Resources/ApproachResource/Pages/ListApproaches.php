<?php

namespace App\Filament\Resources\ApproachResource\Pages;

use App\Filament\Resources\ApproachResource;
use App\Filament\Resources\ApproachResource\Widgets\UpdateApproachSectionWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApproaches extends ListRecords
{
    protected static string $resource = ApproachResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
