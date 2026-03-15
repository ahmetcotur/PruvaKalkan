<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$html = file_get_contents('https://eliakas.com.tr/menu/');
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

$categories = $xpath->query("//h2[contains(@class, 'elementor-heading-title')]");
echo "Categories found:\n";
foreach ($categories as $cat) {
    echo "- " . trim($cat->nodeValue) . "\n";
}

$items = $xpath->query("//div[contains(@class, 'elementor-price-list')]//li");
if ($items->length === 0) {
    // maybe try to find regular text
    $items = $xpath->query("//h3[contains(@class, 'elementor-heading-title')]");
}
echo "Items sample (first 10):\n";
for ($i = 0; $i < min(10, $items->length); $i++) {
    echo "- " . trim($items->item($i)->nodeValue) . "\n";
}
