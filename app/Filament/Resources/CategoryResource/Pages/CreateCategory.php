<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateCategory extends CreateRecord
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
            $data['image'] = \App\Services\ImageService::process($data['image'], 'categories');
        }

        return $data;
    }

    protected static string $resource = CategoryResource::class;
}
