<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['value'];

    public static function getValue(string $key, $default = null, string $size = '')
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) return $default;

        $processValue = function($val) use ($size) {
            if (!$val) return null;
            
            // Apply size suffix for webp images
            if ($size && in_array($size, ['m', 's']) && str_ends_with($val, '.webp')) {
                $val = str_replace('.webp', '_' . $size . '.webp', $val);
            }

            return str_starts_with($val, 'http') ? $val : asset('storage/' . $val);
        };

        if ($setting->type === 'image') {
            return $processValue($setting->value) ?? $default;
        }

        if ($setting->type === 'images') {
            if (is_array($setting->value)) {
                return array_map($processValue, $setting->value);
            }
            return is_array($default) ? $default : [];
        }

        return $setting->value ?? $default;
    }
}
