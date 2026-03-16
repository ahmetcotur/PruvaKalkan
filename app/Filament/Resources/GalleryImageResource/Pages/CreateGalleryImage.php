<?php

namespace App\Filament\Resources\GalleryImageResource\Pages;

use App\Filament\Resources\GalleryImageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateGalleryImage extends CreateRecord
{
    use Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['image'])) {
            $data['image'] = \App\Services\ImageService::process($data['image'], 'gallery');
        }

        return $data;
    }

    protected static string $resource = GalleryImageResource::class;
}
