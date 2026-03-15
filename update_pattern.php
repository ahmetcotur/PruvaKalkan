<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$iterator = new RecursiveIteratorIterator($dir);

// New Olive Branch SVG (Simplified and more visible)
$newSvg = "data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%235B6E4E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' opacity='0.1'%3E%3Cpath d='M60 100 C 60 70 45 40 20 20'/%3E%3Cpath d='M60 100 C 65 70 85 40 110 20'/%3E%3Cellipse cx='35' cy='45' rx='10' ry='5' transform='rotate(-35 35 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='45' cy='75' rx='8' ry='4' transform='rotate(-45 45 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='85' cy='45' rx='10' ry='5' transform='rotate(35 85 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='75' cy='75' rx='8' ry='4' transform='rotate(45 75 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Ccircle cx='60' cy='60' r='4' fill='%235B6E4E'/%3E%3Ccircle cx='55' cy='85' r='3.5' fill='%235B6E4E'/%3E%3C/g%3E%3C/svg%3E";

$oldSvgPart = "viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 40c0-10 10-20 20-20s20 10 20 20-10 20-20 20-20-10-20-20zm5 0c0 8 7 15 15 15s15-7 15-15-7-15-15-15-15 7-15 15zm-15 30c-5-5-5-15 0-20s15-5 20 0 5 15 0 20-15 5-20 0zm4 4c4 4 12 4 16 0s4-12 0-16-12-4-16 0-4 12 0 16z\'";

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, 'data:image/svg+xml') !== false && strpos($content, '5B6E4E') !== false) {
            // Find the full style attribute that looks like a background pattern
            $content = preg_replace(
                '/style="background-image: url\(\'data:image\/svg\+xml,[^)]+\'\); background-size: 80px 80px;"/',
                'style="background-image: url(\'' . $newSvg . '\'); background-size: 120px 120px;"',
                $content
            );
            file_put_contents($file->getPathname(), $content);
            echo "Updated: " . $file->getPathname() . "\n";
        }
    }
}
