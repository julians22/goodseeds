<?php

namespace App\Filament\Resources\ProvideResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\ProvideResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProvide extends EditRecord
{
    protected static string $resource = ProvideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
