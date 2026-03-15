<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\BlogPost;

$string = BlogPost::first()->getTranslations("title")["tr"];
echo "Original: " . $string . "\n";
echo "mb_convert_encoding (ISO to UTF): " . mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8') . "\n";
// This is typical for latin1 double encoding
echo "utf8_decode: " . utf8_decode($string) . "\n";

