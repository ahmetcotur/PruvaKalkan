<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateBlogPost extends CreateRecord
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
            $data['image'] = \App\Services\ImageService::process($data['image'], 'blog');
        }

        return $data;
    }

    protected static string $resource = BlogPostResource::class;
}
