<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateMenuItem extends CreateRecord
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
            $data['image'] = \App\Services\ImageService::process($data['image'], 'menu-items');
        }

        return $data;
    }

    protected static string $resource = MenuItemResource::class;
}
