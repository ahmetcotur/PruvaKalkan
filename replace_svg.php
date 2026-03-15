<?php

$oldSvg = "background-image: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 40c0-10 10-20 20-20s20 10 20 20-10 20-20 20-20-10-20-20zm5 0c0 8 7 15 15 15s15-7 15-15-7-15-15-15-15 7-15 15zm-15 30c-5-5-5-15 0-20s15-5 20 0 5 15 0 20-15 5-20 0zm4 4c4 4 12 4 16 0s4-12 0-16-12-4-16 0-4 12 0 16z\' fill=\'%235B6E4E\' fill-rule=\'evenodd\'/%3E%3C/svg%3E')";

$newSvg = "background-image: url('data:image/svg+xml,%3Csvg width=\'120\' height=\'120\' viewBox=\'0 0 120 120\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%235B6E4E\' fill-rule=\'evenodd\' opacity=\'0.15\'%3E%3Cpath d=\'M11 98c-4-4-4-11 0-15s11-4 15 0 4 11 0 15-11 4-15 0zm4-11c-2 2-2 5 0 7s5 2 7 0 2-5 0-7-5-2-7 0zM35 74c-4-4-4-11 0-15s11-4 15 0 4 11 0 15-11 4-15 0zm4-11c-2 2-2 5 0 7s5 2 7 0 2-5 0-7-5-2-7 0zM59 50c-4-4-4-11 0-15s11-4 15 0 4 11 0 15-11 4-15 0zm4-11c-2 2-2 5 0 7s5 2 7 0 2-5 0-7-5-2-7 0zM83 26c-4-4-4-11 0-15s11-4 15 0 4 11 0 15-11 4-15 0zm4-11c-2 2-2 5 0 7s5 2 7 0 2-5 0-7-5-2-7 0z\'/%3E%3Cpath d=\'M9 111L110 10l3 3L12 114z\'/%3E%3Ccircle cx=\'28\' cy=\'82\' r=\'4\'/%3E%3Ccircle cx=\'52\' cy=\'58\' r=\'4\'/%3E%3Ccircle cx=\'76\' cy=\'34\' r=\'4\'/%3E%3C/g%3E%3C/svg%3E')";

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(resource_path('views'))
);

$count = 0;
foreach ($files as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $path = $file->getRealPath();
        $content = file_get_contents($path);
        
        if (strpos($content, $oldSvg) !== false) {
            $content = str_replace($oldSvg, $newSvg, $content);
            $content = str_replace('background-size: 80px 80px;', 'background-size: 150px 150px;', $content);
            file_put_contents($path, $content);
            $count++;
            echo "Updated: {$path}\n";
        }
    }
}

echo "Total files updated: {$count}\n";
