<?php

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSlide extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = SlideResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['image'])) {
            $data['image'] = \App\Services\ImageService::process($data['image'], 'slides');
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
