<?php

namespace App\Filament\Resources\ApproachResource\Pages;

use App\Filament\Resources\ApproachResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApproach extends EditRecord
{
    protected static string $resource = ApproachResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
