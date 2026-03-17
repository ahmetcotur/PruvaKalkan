<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasResponsiveImages
{
    public function getImageUrl(string $size = '', string $column = 'image'): ?string
    {
        $value = $this->$column;

        if (empty($value)) {
            return null;
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        $extension = pathinfo($value, PATHINFO_EXTENSION);
        $originalValue = $value;
        $sizedValue = $value;
        
        if ($size && in_array($size, ['m', 's'])) {
            $sizedValue = str_replace('.' . $extension, '_' . $size . '.' . $extension, $value);
        }

        // 1. Check in public/images (for starter assets)
        if (file_exists(public_path('images/' . $sizedValue))) {
            return asset('images/' . $sizedValue);
        }
        if ($sizedValue !== $originalValue && file_exists(public_path('images/' . $originalValue))) {
             return asset('images/' . $originalValue);
        }

        // 2. Check in storage (for user uploads)
        // We use Storage::exists for a cleaner check on the storage disk
        if (Storage::disk('public')->exists($sizedValue)) {
            return asset('storage/' . $sizedValue);
        }

        return asset('storage/' . $originalValue);
    }
}
