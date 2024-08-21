<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Models\Banner;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        /** @var Banner $banner */
        $banner = $this->record;

        if ($banner->primary_text) {
            $exceptBanner = Banner::withoutGlobalScope(SoftDeletingScope::class)->where('id', '!=', $banner->id)->get();
            $exceptBanner->each(function ($banner) {
                $banner->update(['primary_text' => false]);
            });
        }
    }
}
