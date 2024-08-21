<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Models\Banner;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected function afterCreate(): void
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
