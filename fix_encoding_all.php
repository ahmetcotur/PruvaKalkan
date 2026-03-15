<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\BlogPost;
use Spatie\TranslationLoader\LanguageLine;

function fixMojibake($string) {
    if (empty($string)) return $string;
    if (!is_string($string)) return $string; // Skip arrays or numbers
    
    // Check if it actually contains Mojibake patterns like Ã¼ (ü) or Ã§ (ç) or Ä± (ı) or ÅŸ (ş)
    if (!preg_match('/Ã[A-Za-z0-9]|Ä[A-Za-z0-9]|Å[A-Za-z0-9]|Ã¼|Ã§|Ä±|ÅŸ|Ã¶|Ã–|Ã‡|Åž|Ä°|Ãœ/', $string)) {
        return $string;
    }

    // Windows-1252 correctly maps the problematic characters
    $decoded = @mb_convert_encoding($string, 'Windows-1252', 'UTF-8');
    
    if ($decoded === false) {
        return $string;
    }
    
    return $decoded;
}

echo "Fixing Categories...\n";
$categories = Category::all();
$catCount = 0;
foreach ($categories as $cat) {
    $changed = false;
    foreach (['name', 'slug', 'description'] as $field) {
        $translations = $cat->getTranslations($field);
        foreach ($translations as $locale => $t) {
            $fixed = fixMojibake($t);
            if ($fixed !== $t && $fixed !== '') {
                $translations[$locale] = $fixed;
                $changed = true;
            }
        }
        if ($changed) $cat->setTranslations($field, $translations);
    }
    if ($changed) {
        $cat->save();
        $catCount++;
    }
}
echo "Fixed $catCount categories.\n\n";

echo "Fixing Menu Items...\n";
$menuItems = MenuItem::all();
$menuCount = 0;
foreach ($menuItems as $item) {
    $changed = false;
    foreach (['name', 'slug', 'description', 'allergen_info'] as $field) {
        $translations = $item->getTranslations($field);
        if (!$translations) continue;
        
        foreach ($translations as $locale => $t) {
            $fixed = fixMojibake($t);
            if ($fixed !== $t && $fixed !== '') {
                $translations[$locale] = $fixed;
                $changed = true;
            }
        }
        if ($changed) $item->setTranslations($field, $translations);
    }
    if ($changed) {
        $item->save();
        $menuCount++;
    }
}
echo "Fixed $menuCount menu items.\n\n";

echo "Fixing Settings...\n";
$settings = Setting::all();
$setCount = 0;
foreach ($settings as $setting) {
    $val = $setting->value;
    if (is_string($val)) {
        $fixed = fixMojibake($val);
        if ($fixed !== $val && $fixed !== '') {
            $setting->value = $fixed;
            $setting->save();
            $setCount++;
        }
    }
}
echo "Fixed $setCount settings.\n\n";

echo "All Done!\n";
