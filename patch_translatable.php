<?php
require 'vendor/autoload.php';

use Illuminate\Support\Str;

$resources = ['CategoryResource', 'MenuItemResource', 'GalleryImageResource'];

foreach ($resources as $res) {
    // 1. Resource Class
    $path = "app/Filament/Resources/{$res}.php";
    if (file_exists($path)) {
        $content = file_get_contents($path);
        if (!str_contains($content, 'use Filament\Resources\Concerns\Translatable;')) {
            $content = preg_replace(
                '/use Filament\\\\Resources\\\\Resource;/',
                "use Filament\\Resources\\Resource;\nuse Filament\\Resources\\Concerns\\Translatable;",
                $content
            );
            $content = preg_replace(
                '/(class\s+'.$res.'\s+extends\s+Resource\s*\{)(?!\s*use Translatable;)/',
                "$1\n    use Translatable;\n",
                $content
            );
            file_put_contents($path, $content);
        }
    }

    $baseName = str_replace('Resource', '', $res);
    $pluralName = Str::plural($baseName);

    // 2. List Page
    $listPath = "app/Filament/Resources/{$res}/Pages/List{$pluralName}.php";
    if (file_exists($listPath)) {
        $content = file_get_contents($listPath);
        if(!str_contains($content, 'Concerns\Translatable')){
            $content = preg_replace(
                '/(class\s+List'.$pluralName.'\s+extends\s+ListRecords\s*\{)/',
                "$1\n    use ListRecords\\Concerns\\Translatable;\n",
                $content
            );
            $content = preg_replace(
                '/(return\s*\[\s*Actions\\\\CreateAction::make\(\),)/',
                "$1\n            Actions\\LocaleSwitcher::make(),",
                $content
            );
            file_put_contents($listPath, $content);
        }
    }

    // 3. Create Page
    $createPath = "app/Filament/Resources/{$res}/Pages/Create{$baseName}.php";
    if (file_exists($createPath)) {
        $content = file_get_contents($createPath);
        if(!str_contains($content, 'Concerns\Translatable')){
            $content = preg_replace(
                '/(class\s+Create'.$baseName.'\s+extends\s+CreateRecord\s*\{)/',
                "$1\n    use CreateRecord\\Concerns\\Translatable;\n",
                $content
            );
            $content = preg_replace(
                '/(protected function getHeaderActions\(\): array\s*\{\s*return\s*\[)/',
                "$1\n            Actions\\LocaleSwitcher::make(),",
                $content
            );
            if (!str_contains($content, 'getHeaderActions')) {
                $content = preg_replace(
                    '/(class\s+Create'.$baseName.'\s+extends\s+CreateRecord\s*\{\s*use CreateRecord\\\\Concerns\\\\Translatable;\n)/',
                    "$1\n    protected function getHeaderActions(): array\n    {\n        return [\n            \\Filament\\Actions\\LocaleSwitcher::make(),\n        ];\n    }\n",
                    $content
                );
            }
            file_put_contents($createPath, $content);
        }
    }

    // 4. Edit Page
    $editPath = "app/Filament/Resources/{$res}/Pages/Edit{$baseName}.php";
    if (file_exists($editPath)) {
        $content = file_get_contents($editPath);
        if(!str_contains($content, 'Concerns\Translatable')){
            $content = preg_replace(
                '/(class\s+Edit'.$baseName.'\s+extends\s+EditRecord\s*\{)/',
                "$1\n    use EditRecord\\Concerns\\Translatable;\n",
                $content
            );
            $content = preg_replace(
                '/(return\s*\[\s*Actions\\\\DeleteAction::make\(\),)/',
                "return [\n            Actions\\LocaleSwitcher::make(),\n            Actions\\DeleteAction::make(),",
                $content
            );
            file_put_contents($editPath, $content);
        }
    }
}

// 5. AdminPanelProvider.php
$providerPath = "app/Providers/Filament/AdminPanelProvider.php";
$content = file_get_contents($providerPath);
if (!str_contains($content, 'SpatieLaravelTranslatablePlugin')) {
    $content = preg_replace(
        '/namespace App\\\\Providers\\\\Filament;/',
        "namespace App\\Providers\\Filament;\n\nuse Filament\\SpatieLaravelTranslatablePlugin\\SpatieLaravelTranslatablePlugin;",
        $content
    );
    $content = preg_replace(
        '/(->authMiddleware\(\[\s*Authenticate::class,\s*\]\))/',
        "$1\n            ->plugin(SpatieLaravelTranslatablePlugin::make()->defaultLocales(['tr', 'en']))",
        $content
    );
    file_put_contents($providerPath, $content);
}

echo "Patched Filament configuration effectively done.\n";

