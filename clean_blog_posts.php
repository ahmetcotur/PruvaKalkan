<?php

use App\Models\BlogPost;

$posts = BlogPost::all();

foreach ($posts as $post) {
    foreach(['tr', 'en'] as $lang) {
        $content = $post->getTranslation('content', $lang, false);
        if ($content) {
            // Find the start of the WordPress RSS footer
            $pos = strpos($content, '<p>The post <a');
            if ($pos !== false) {
                // Slice off everything after that point
                $content = substr($content, 0, $pos);
                $content = trim($content);
                
                // Remove trailing empty paragraph if injected by WP
                if (substr($content, -7) === '<p></p>') {
                    $content = substr($content, 0, -7);
                }
                $post->setTranslation('content', $lang, trim($content));
            }
        }
    }
    $post->save();
}

echo "Cleaned " . count($posts) . " posts.\n";
