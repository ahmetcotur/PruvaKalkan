<?php

namespace App\Filament\Resources\GalleryImageResource\Pages;

use App\Filament\Resources\GalleryImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditGalleryImage extends EditRecord
{
    use Translatable;
    protected static string $resource = GalleryImageResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['image']) && $data['image'] !== $this->record->image) {
            $data['image'] = \App\Services\ImageService::process($data['image'], 'gallery');
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
