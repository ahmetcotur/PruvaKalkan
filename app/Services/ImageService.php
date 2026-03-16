<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public static function process($paths, string $directory): array|string|null
    {
        if (empty($paths)) return $paths;

        if (is_array($paths)) {
            return array_map(fn($path) => self::processSingle($path, $directory), $paths);
        }

        return self::processSingle($paths, $directory);
    }

    private static function processSingle(string $path, string $directory): string
    {
        $disk = 'public';

        if (!Storage::disk($disk)->exists($path)) {
            return $path;
        }

        // Ensure directory exists
        if (!Storage::disk($disk)->exists($directory)) {
            Storage::disk($disk)->makeDirectory($directory);
        }

        $filename = Str::random(40);
        $fullPath = Storage::disk($disk)->path($path);
        
        try {
            $image = Image::read($fullPath);
        } catch (\Throwable $e) {
            return $path; // Fallback to original if reading fails
        }

        // Sizes: Large (Default), Medium, Small
        $sizes = [
            '' => 1920,
            '_m' => 800,
            '_s' => 400,
        ];

        $finalPath = "";

        foreach ($sizes as $suffix => $width) {
            $resizedImage = clone $image;
            
            if ($resizedImage->width() > $width) {
                $resizedImage->scale(width: $width);
            }

            $webpFilename = $filename . $suffix . '.webp';
            $webpPath = $directory . '/' . $webpFilename;
            
            // To prevent potential memory issues with large files, we use 80 quality
            $resizedImage->toWebp(80)->save(Storage::disk($disk)->path($webpPath));

            if ($suffix === '') {
                $finalPath = $webpPath;
            }
        }

        // Attempt to delete original if it's not the same as final
        if ($path !== $finalPath) {
            Storage::disk($disk)->delete($path);
        }

        return $finalPath;
    }
}
