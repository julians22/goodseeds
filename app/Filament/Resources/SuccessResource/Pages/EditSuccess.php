<?php

namespace App\Filament\Resources\SuccessResource\Pages;

use App\Filament\Resources\SuccessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuccess extends EditRecord
{
    protected static string $resource = SuccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
