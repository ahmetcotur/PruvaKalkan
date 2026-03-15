<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['value'];

    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) return $default;

        if ($setting->type === 'image') {
            $val = $setting->value;
            if (!$val) return $default;
            return str_starts_with($val, 'http') ? $val : asset('storage/' . $val);
        }

        if ($setting->type === 'images') {
            if (is_array($setting->value)) {
                return array_map(function($img) {
                    return str_starts_with($img, 'http') ? $img : asset('storage/' . $img);
                }, $setting->value);
            }
            return is_array($default) ? $default : [];
        }

        return $setting->value ?? $default;
    }
}
