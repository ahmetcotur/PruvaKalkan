<?php

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSlide extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SlideResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['image']) && $data['image'] !== $this->record->image) {
            $data['image'] = \App\Services\ImageService::process($data['image'], 'slides');
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
