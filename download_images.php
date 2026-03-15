<?php
$url = 'https://eliakas.com.tr/galeri/';
$html = file_get_contents($url);

if (!$html) {
    die("Failed to fetch HTML\n");
}

preg_match_all('/<a[^>]+href="(https:\/\/eliakas\.com\.tr\/wp-content\/uploads\/[^"]+\.(?:jpg|jpeg|png))"[^>]*>/i', $html, $matches);

$imageUrls = array_unique($matches[1]);
echo "Found " . count($imageUrls) . " images.\n";

$downloadDir = __DIR__ . '/public/images/gallery';
if (!is_dir($downloadDir)) {
    mkdir($downloadDir, 0777, true);
}

// Clean up old zip images
$oldImagesDir = __DIR__ . '/public/images';
foreach (glob($oldImagesDir . '/resource_*.png') as $file) {
    unlink($file);
}

$downloadedCount = 0;
foreach ($imageUrls as $imgUrl) {
    $filename = basename($imgUrl);
    $filepath = $downloadDir . '/' . $filename;
    
    // Some urls might be duplicated in galleries (thumbnails vs full), let's just grab the unique filenames
    if (!file_exists($filepath)) {
        echo "Downloading: $filename\n";
        $imgData = file_get_contents($imgUrl);
        if ($imgData !== false) {
            file_put_contents($filepath, $imgData);
            $downloadedCount++;
        }
    }
}

echo "Successfully downloaded $downloadedCount images.\n";
