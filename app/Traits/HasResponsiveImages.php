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

        if ($size && in_array($size, ['m', 's'])) {
            $value = str_replace('.webp', '_' . $size . '.webp', $value);
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        return asset('storage/' . $value);
    }
}
