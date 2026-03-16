<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
class CreateSetting extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $type = $data['type'];
        $isTranslatable = $data['group'] === 'seo' || $data['group'] === 'homepage' || in_array($data['key'], ['site_name', 'address']);
        
        if ($isTranslatable) {
            $trValue = match($type) {
                'color' => $data['value_color_tr'] ?? '',
                'image' => !empty($data['value_image_tr']) ? \App\Services\ImageService::process($data['value_image_tr'], 'settings') : '',
                'images' => !empty($data['value_images_tr']) ? \App\Services\ImageService::process($data['value_images_tr'], 'settings') : [],
                'boolean' => $data['value_boolean_tr'] ?? '',
                default => $data['value_tr'] ?? '',
            };

            $enValue = match($type) {
                'color' => $data['value_color_en'] ?? '',
                'image' => !empty($data['value_image_en']) ? \App\Services\ImageService::process($data['value_image_en'], 'settings') : '',
                'images' => !empty($data['value_images_en']) ? \App\Services\ImageService::process($data['value_images_en'], 'settings') : [],
                'boolean' => $data['value_boolean_en'] ?? '',
                default => $data['value_en'] ?? '',
            };

            $data['value'] = [
                'tr' => $trValue,
                'en' => $enValue,
            ];
        } else {
            $globalVal = match($type) {
                'color' => $data['value_color_global'] ?? '',
                'image' => !empty($data['value_image_global']) ? \App\Services\ImageService::process($data['value_image_global'], 'settings') : '',
                'images' => !empty($data['value_images_global']) ? \App\Services\ImageService::process($data['value_images_global'], 'settings') : [],
                'boolean' => $data['value_boolean_global'] ?? '',
                default => $data['value_global'] ?? '',
            };

            // Save for both locales to satisfy Spatie Translatable
            $data['value'] = [
                'tr' => $globalVal,
                'en' => $globalVal,
            ];
        }

        // Clean up temporary fields to avoid "Column not found" SQL errors
        unset($data['value_tr'], $data['value_color_tr'], $data['value_image_tr'], $data['value_images_tr'], $data['value_boolean_tr']);
        unset($data['value_en'], $data['value_color_en'], $data['value_image_en'], $data['value_images_en'], $data['value_boolean_en']);
        unset($data['value_global'], $data['value_color_global'], $data['value_image_global'], $data['value_images_global'], $data['value_boolean_global']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
    protected static string $resource = SettingResource::class;
}
