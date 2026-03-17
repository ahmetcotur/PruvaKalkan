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
        if ($size && in_array($size, ['m', 's'])) {
            $value = str_replace('.' . $extension, '_' . $size . '.' . $extension, $value);
        }

        if (file_exists(public_path('images/' . $value))) {
            return asset('images/' . $value);
        }

        return asset('storage/' . $value);
    }
}
