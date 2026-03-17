<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use App\Models\GalleryImage;
use App\Models\Slide;
use App\Models\Category;
use App\Models\BlogPost;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class RepairResponsiveImages extends Command
{
    protected $signature = 'settings:repair-images';
    protected $description = 'Regenerates missing responsive image variants (_m, _s) for all models.';

    public function handle()
    {
        $this->info('Starting image repair process...');

        $this->processModel(Setting::class, 'value', 'settings', true);
        $this->processModel(GalleryImage::class, 'image', 'gallery', false);
        $this->processModel(Slide::class, 'image', 'slides', false);
        $this->processModel(Category::class, 'image', 'categories', false);
        $this->processModel(BlogPost::class, 'image', 'blog', false);

        $this->info('Image repair process completed.');
    }

    private function processModel($modelClass, $column, $directory, $isTranslatable)
    {
        $this->info("Processing {$modelClass}...");
        $records = $modelClass::all();

        foreach ($records as $record) {
            if ($isTranslatable) {
                // Use getTranslations to get the raw array for translatable fields
                $translations = $record->getTranslations($column);
                $updated = false;
                
                foreach ($translations as $lang => $path) {
                    if ($this->shouldReprocess($path)) {
                        $this->line("  Reprocessing [{$lang}] {$path}");
                        $newPath = ImageService::process($path, $directory);
                        if ($newPath !== $path) {
                            $record->setTranslation($column, $lang, $newPath);
                            $updated = true;
                        }
                    }
                }
                if ($updated) $record->save();
            } else {
                $path = $record->$column;
                if ($this->shouldReprocess($path)) {
                    $this->line("  Reprocessing {$path}");
                    $newPath = ImageService::process($path, $directory);
                    if ($newPath !== $path) {
                        $record->$column = $newPath;
                        $record->save();
                    }
                }
            }
        }
    }

    private function shouldReprocess($path)
    {
        if (empty($path)) return false;
        
        // Skip JSON arrays (for multiple images type in settings)
        if (is_array($path)) return false; 
        if (is_string($path) && str_starts_with($path, '[')) return false;

        if (filter_var($path, FILTER_VALIDATE_URL)) return false;

        $disk = 'public';
        if (!Storage::disk($disk)->exists($path)) return false;

        // If it's a webp, check if variants exist
        if (str_ends_with($path, '.webp')) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $mPath = str_replace('.' . $extension, '_m.' . $extension, $path);
            $sPath = str_replace('.' . $extension, '_s.' . $extension, $path);

            return !Storage::disk($disk)->exists($mPath) || !Storage::disk($disk)->exists($sPath);
        }

        // If it's not a webp (jpg, png etc), we definitely want to reprocess it to get WebP + variants
        return true;
    }
}
