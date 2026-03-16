<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditMenuItem extends EditRecord
{
    use Translatable;
    protected static string $resource = MenuItemResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['image']) && $data['image'] !== $this->record->image) {
            $data['image'] = \App\Services\ImageService::process($data['image'], 'menu-items');
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
