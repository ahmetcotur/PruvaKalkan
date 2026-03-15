<?php

// Fix Mojibake (double-encoded UTF-8) in database

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;

function fixMojibake($string) {
    if (empty($string)) return $string;
    
    // Windows-1252 correctly maps the problematic characters like ş
    $decoded = mb_convert_encoding($string, 'Windows-1252', 'UTF-8');
    
    return $decoded;
}


$posts = BlogPost::all();
$fixedCount = 0;

foreach ($posts as $post) {
    $title = $post->getTranslations('title');
    $content = $post->getTranslations('content');
    $description = $post->getTranslations('description');
    
    $changed = false;
    
    foreach ($title as $locale => $t) {
        $fixed = fixMojibake($t);
        if ($fixed !== $t && $fixed !== '') {
            $title[$locale] = $fixed;
            $changed = true;
        }
    }
    
    foreach ($content as $locale => $c) {
        $fixed = fixMojibake($c);
        if ($fixed !== $c && $fixed !== '') {
            $content[$locale] = $fixed;
            $changed = true;
        }
    }
    
    foreach ($description as $locale => $d) {
        $fixed = fixMojibake($d);
        if ($fixed !== $d && $fixed !== '') {
            $description[$locale] = $fixed;
            $changed = true;
        }
    }
    
    if ($changed) {
        $post->setTranslations('title', $title);
        $post->setTranslations('content', $content);
        $post->setTranslations('description', $description);
        $post->save();
        $fixedCount++;
        echo "Fixed post ID: {$post->id}\n";
    }
}

echo "Total posts fixed: {$fixedCount}\n";
