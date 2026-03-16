<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Support\Str;

class BeverageMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Find existing "İçecek Menüsü" or create if not exists
        $drinkCat = Category::where('name->tr', 'İçecek Menüsü')
            ->orWhere('name->en', 'Drink Menu')
            ->first();

        if (!$drinkCat) {
            $drinkCat = Category::create([
                'name' => ['en' => 'Drink Menu', 'tr' => 'İçecek Menüsü'],
                'slug' => ['en' => 'drink-menu', 'tr' => 'icecek-menusu'],
                'description' => ['en' => 'Signature sunset cocktails and a curated local wines.', 'tr' => 'Aromatik imza kokteyllerimiz, özel şarap ve içecek kavımız.'],
                'is_active' => true,
                'order_column' => 3,
            ]);
        }

        // Clean up subcategories under "İçecek Menüsü" except "Şaraplar" (ID 27 is usually wines, let's keep it if it exists)
        // Actually, let's just delete categories that we are going to replace
        $subCatNames = [
            'İçecekler', 'Rakılar', 'Biralar', 'Sıcak İçecekler', 'Viskiler', 'Vodkalar', 
            'Cin', 'İthal İçkiler', 'Tekila', 'Kokteyller', 'Alkolsüz Kokteyller'
        ];

        foreach ($subCatNames as $name) {
            $cat = Category::where('parent_id', $drinkCat->id)
                ->where('name->tr', $name)
                ->first();
            if ($cat) {
                MenuItem::where('category_id', $cat->id)->delete();
                $cat->delete();
            }
        }

        // 1. SOFT DRINKS / İÇECEKLER
        $softDrinks = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Soft Drinks', 'tr' => 'İçecekler'],
            'order_column' => 1,
            'is_active' => true
        ]);
        $this->seedItems($softDrinks->id, [
            ['tr' => 'Su 1 Litre', 'en' => 'Water 1 Litre', 'price' => 100],
            ['tr' => 'Soda 1 Litre', 'en' => 'Mineral Water 1 Litre', 'price' => 150],
            ['tr' => 'Soda', 'en' => 'Small Mineral Water', 'price' => 60],
            ['tr' => 'Tonik', 'en' => 'Tonic Water', 'price' => 150],
            ['tr' => 'Kola, Fanta, Sprite, Cola Zero, Ice Tea', 'en' => 'Cola, Fanta, Sprite, Cola Zero, Ice Tea', 'price' => 150],
            ['tr' => 'Meyve Suları (Şeftali, Ananas, Vişne, Portakal)', 'en' => 'Fruit Juices (Peach, Pineapple, Cherry, Orange)', 'price' => 150],
            ['tr' => 'Milkshakeler (Vanilya, Çikolata, Muz)', 'en' => 'Milkshakes (Vanilla, Chocolate, Banana)', 'price' => 300],
            ['tr' => 'Ev Yapımı Limonata', 'en' => 'Homemade Lemonade', 'price' => 250],
            ['tr' => 'Taze Portakal Suyu', 'en' => 'Fresh Orange Juice', 'price' => 250],
            ['tr' => 'Redbull', 'en' => 'Redbull', 'price' => 200],
        ]);

        // 2. HOT DRINKS / SICAK İÇECEKLER
        $hotDrinks = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Hot Drinks', 'tr' => 'Sıcak İçecekler'],
            'order_column' => 2,
            'is_active' => true
        ]);
        $this->seedItems($hotDrinks->id, [
            ['tr' => 'Americano', 'en' => 'Americano', 'price' => 160],
            ['tr' => 'Cappuccino, Latte', 'en' => 'Cappuccino, Latte', 'price' => 180],
            ['tr' => 'Iced Coffee', 'en' => 'Iced Coffee', 'price' => 300],
            ['tr' => 'Espresso', 'en' => 'Espresso', 'price' => 140],
            ['tr' => 'Türk Kahvesi', 'en' => 'Turkish Coffee', 'price' => 130],
            ['tr' => 'Irish Coffee (Baileys, Tia Maria, Kahlua)', 'en' => 'Irish Coffee (Baileys, Tia Maria, Kahlua)', 'price' => 500],
            ['tr' => 'Çay', 'en' => 'Tea', 'price' => 50],
            ['tr' => 'Elma Çayı', 'en' => 'Apple Tea', 'price' => 50],
        ]);

        // 3. BEERS / BİRALAR
        $beers = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Beers', 'tr' => 'Biralar'],
            'order_column' => 3,
            'is_active' => true
        ]);
        $this->seedItems($beers->id, [
            ['tr' => 'Efes 50 cl', 'en' => 'Efes 50 cl', 'price' => 250],
            ['tr' => 'Tuborg Gold', 'en' => 'Tuborg Gold', 'price' => 280],
            ['tr' => 'Corona, Miller, Becks, Apple Cider', 'en' => 'Corona, Miller, Becks, Apple Cider', 'price' => 340],
            ['tr' => 'Carlsberg', 'en' => 'Carlsberg', 'price' => 340],
            ['tr' => 'Filtresiz Bomonti', 'en' => 'Bomonti Unfiltered', 'price' => 320],
        ]);

        // 4. WHISKIES / VİSKİLER
        $whiskies = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Whiskies', 'tr' => 'Viskiler'],
            'order_column' => 4,
            'is_active' => true
        ]);
        $this->seedItems($whiskies->id, [
            ['tr' => 'Chivas Regal', 'en' => 'Chivas Regal', 'price' => 550],
            ['tr' => 'Red Label', 'en' => 'Red Label', 'price' => 400],
            ['tr' => 'Black Label', 'en' => 'Black Label', 'price' => 450],
            ['tr' => 'Jack Daniel\'s', 'en' => 'Jack Daniel\'s', 'price' => 500],
        ], "Mixers (Tonic, Sprite, Cola) fiyatlara dahil değildir.");

        // 5. VODKA / VODKALAR
        $vodkas = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Vodkas', 'tr' => 'Vodkalar'],
            'order_column' => 5,
            'is_active' => true
        ]);
        $this->seedItems($vodkas->id, [
            ['tr' => 'Yerli Vodka', 'en' => 'Local Vodka', 'price' => 300],
            ['tr' => 'Smirnoff Red', 'en' => 'Smirnoff Red', 'price' => 400],
            ['tr' => 'Absolut', 'en' => 'Absolut', 'price' => 450],
        ], "Mixers (Tonic, Sprite, Cola) fiyatlara dahil değildir.");

        // 6. GIN / CİN
        $gin = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Gin', 'tr' => 'Cin'],
            'order_column' => 6,
            'is_active' => true
        ]);
        $this->seedItems($gin->id, [
            ['tr' => 'Yerli Cin', 'en' => 'Local Cin', 'price' => 300],
            ['tr' => 'Gordon\'s, Gordon\'s Pink', 'en' => 'Gordon\'s, Gordon\'s Pink', 'price' => 400],
            ['tr' => 'Bombay', 'en' => 'Bombay', 'price' => 450],
            ['tr' => 'Hendrick\'s', 'en' => 'Hendrick\'s', 'price' => 500],
            ['tr' => 'Tanqueray London Dry Gin', 'en' => 'Tanqueray London Dry Gin', 'price' => 450],
        ], "Mixers (Tonic, Sprite, Cola) fiyatlara dahil değildir.");

        // 7. IMPORTS / İTHAL İÇKİLER
        $imports = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Imports', 'tr' => 'İthal İçkiler'],
            'order_column' => 7,
            'is_active' => true
        ]);
        $this->seedItems($imports->id, [
            ['tr' => 'Bacardi', 'en' => 'Bacardi', 'price' => 450],
            ['tr' => 'Kaptan Morgan', 'en' => 'Captain Morgan', 'price' => 400],
            ['tr' => 'Malibu', 'en' => 'Malibu', 'price' => 300],
            ['tr' => 'Baileys', 'en' => 'Baileys', 'price' => 300],
            ['tr' => 'Tia Maria', 'en' => 'Tia Maria', 'price' => 250],
            ['tr' => 'Archers', 'en' => 'Archers', 'price' => 300],
            ['tr' => 'Cointreau', 'en' => 'Cointreau', 'price' => 450],
            ['tr' => 'Disaronno Amaretto', 'en' => 'Disaronno Amaretto', 'price' => 350],
            ['tr' => 'Yerli Brandy', 'en' => 'Local Brandy', 'price' => 350],
            ['tr' => 'Metaxa', 'en' => 'Metaxa', 'price' => 500],
        ], "Mixers (Tonic, Sprite, Cola) fiyatlara dahil değildir.");

        // 8. TEQUILA / TEKİLA
        $tequila = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Tequila', 'tr' => 'Tekila'],
            'order_column' => 8,
            'is_active' => true
        ]);
        $this->seedItems($tequila->id, [
            ['tr' => 'Olmeca', 'en' => 'Olmeca', 'price' => 300],
            ['tr' => 'Sierra', 'en' => 'Sierra', 'price' => 300],
        ]);

        // 9. COCKTAILS / KOKTEYLLER
        $cocktails = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Cocktails', 'tr' => 'Kokteyller'],
            'order_column' => 9,
            'is_active' => true
        ]);
        $this->seedItems($cocktails->id, [
            ['tr' => 'Margarita (Klasik veya Acılı)', 'en' => 'Margarita (Classic or Spicy)', 'price' => 500, 'desc' => ['tr' => 'Tekila, Cointreau, Taze Misket Limonu Suyu, Tuz', 'en' => 'Tequila, Cointreau, Fresh Lime Juice, Salt']],
            ['tr' => 'Çilekli Daiquiri', 'en' => 'Strawberry Daiquiri', 'price' => 550, 'desc' => ['tr' => 'Romat, Taze Çilek, Çilek Şurubu, Buz', 'en' => 'Rum, Fresh Strawberry, Strawberry Syrup, Ice']],
            ['tr' => 'Mojito', 'en' => 'Mojito', 'price' => 500, 'desc' => ['tr' => 'Rom, Esmer Şeker, Lime Şurubu, Soda, Taze Nane, Lime', 'en' => 'Rum, Brown Sugar, Lime Syrup, Soda Water, Fresh Mint, Lime']],
            ['tr' => 'Espresso Martini', 'en' => 'Espresso Martini', 'price' => 500, 'desc' => ['tr' => 'Vodka, Espresso, Kahve Likörü, Şeker Şurubu', 'en' => 'Vodka, Espresso, Coffee Liqueur, Sugar Syrup']],
            ['tr' => 'Long Island Ice Tea', 'en' => 'Long Island Ice Tea', 'price' => 600, 'desc' => ['tr' => 'Vodka, Cin, Tekila, Rom, Triple Sec, Limon Suyu, Şeker Şurubu, Kola', 'en' => 'Vodka, Gin, Tequila, Rum, Triple Sec, Lemon Juice, Sugar Syrup, Cola']],
            ['tr' => 'Pineacolada', 'en' => 'Pineacolada', 'price' => 500, 'desc' => ['tr' => 'Vodka, Malibu, Ananas Suyu, Süt, Krema, Hindistan Cevizi Şurubu', 'en' => 'Vodka, Malibu, Pineapple Juice, Milk, Cream, Coconut Syrup']],
            ['tr' => 'Sex on the Beach', 'en' => 'Sex on the Beach', 'price' => 500, 'desc' => ['tr' => 'Vodka, Archers, Portakal Suyu, Nar Şurubu', 'en' => 'Vodka, Archers, Orange Juice, Pomegranate Syrup']],
            ['tr' => 'Aperol Spritz', 'en' => 'Aperol Spritz', 'price' => 500, 'desc' => ['tr' => 'Aperol, Prosecco, Portakal Dilimi', 'en' => 'Aperol, Prosecco, Orange Slice']],
            ['tr' => 'Pornstar Martini', 'en' => 'Pornstar Martini', 'price' => 600, 'desc' => ['tr' => 'Vodka, Çarkıfelek Likörü, Çarkıfelek Püresi, Vanilya Şurubu, Misket Limonu Suyu, Prosecco', 'en' => 'Vodka, Passion Fruit Liqueur, Passion Fruit Purée, Vanilla Syrup, Lime Juice, Prosecco']],
        ]);

        // 10. MOCKTAILS / ALKOLSÜZ KOKTEYLLER
        $mocktails = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Mocktails', 'tr' => 'Alkolsüz Kokteyller'],
            'order_column' => 10,
            'is_active' => true
        ]);
        $this->seedItems($mocktails->id, [
            ['tr' => 'Mickey Mouse', 'en' => 'Mickey Mouse', 'price' => 350, 'desc' => ['tr' => 'Ananas suyu, Portakal suyu, şeftali suyu, mavi curaçao Şurubu', 'en' => 'Pineapple Juice, Orange juice, peach juice, blue curaçao Syrup']],
            ['tr' => 'Cinderella', 'en' => 'Cinderella', 'price' => 350, 'desc' => ['tr' => 'Portakal Suyu, Ananas Suyu, elma suyu, Grenadin', 'en' => 'Orange Juice, Pineapple Juice, apple juice, Grenadine']],
        ]);

        // 11. RAKILAR
        $rakis = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Rakis', 'tr' => 'Rakılar'],
            'order_column' => 11,
            'is_active' => true
        ]);
        $this->seedItems($rakis->id, [
            ['tr' => 'YENİ RAKI YENİ SERİ TEK', 'en' => 'YENİ RAKI YENİ SERİ SINGLE', 'price' => 300],
            ['tr' => 'YENİ RAKI YENİ SERİ DUBLE', 'en' => 'YENİ RAKI YENİ SERİ DOUBLE', 'price' => 450],
            ['tr' => 'YENİ RAKI YENİ SERİ 20 CL', 'en' => 'YENİ RAKI YENİ SERİ 20 CL', 'price' => 1100],
            ['tr' => 'YENİ RAKI YENİ SERİ 35 CL', 'en' => 'YENİ RAKI YENİ SERİ 35 CL', 'price' => 1500],
            ['tr' => 'YENİ RAKI YENİ SERİ 50 CL', 'en' => 'YENİ RAKI YENİ SERİ 50 CL', 'price' => 2200],
            ['tr' => 'YENİ RAKI YENİ SERİ 70 CL', 'en' => 'YENİ RAKI YENİ SERİ 70 CL', 'price' => 2750],

            ['tr' => 'TEKİRDAĞ ALTIN SERİ TEK', 'en' => 'TEKİRDAĞ ALTIN SERİ SINGLE', 'price' => 350],
            ['tr' => 'TEKİRDAĞ ALTIN SERİ DUBLE', 'en' => 'TEKİRDAĞ ALTIN SERİ DOUBLE', 'price' => 500],
            ['tr' => 'TEKİRDAĞ ALTIN SERİ 20 CL', 'en' => 'TEKİRDAĞ ALTIN SERİ 20 CL', 'price' => 1300],
            ['tr' => 'TEKİRDAĞ ALTIN SERİ 35 CL', 'en' => 'TEKİRDAĞ ALTIN SERİ 35 CL', 'price' => 1900],
            ['tr' => 'TEKİRDAĞ ALTIN SERİ 50 CL', 'en' => 'TEKİRDAĞ ALTIN SERİ 50 CL', 'price' => 2500],
            ['tr' => 'TEKİRDAĞ ALTIN SERİ 70 CL', 'en' => 'TEKİRDAĞ ALTIN SERİ 70 CL', 'price' => 3300],

            ['tr' => 'TEKİRDAĞ RAKISI GÖBEK TEK', 'en' => 'TEKİRDAĞ GÖBEK RAKISI SINGLE', 'price' => 350],
            ['tr' => 'TEKİRDAĞ RAKISI GÖBEK DUBLE', 'en' => 'TEKİRDAĞ GÖBEK RAKISI DOUBLE', 'price' => 500],
            ['tr' => 'TEKİRDAĞ RAKISI GÖBEK 35 CL', 'en' => 'TEKİRDAĞ GÖBEK RAKISI 35 CL', 'price' => 1950],
            ['tr' => 'TEKİRDAĞ RAKISI GÖBEK 50 CL', 'en' => 'TEKİRDAĞ GÖBEK RAKISI 50 CL', 'price' => 2600],
            ['tr' => 'TEKİRDAĞ RAKISI GÖBEK 70 CL', 'en' => 'TEKİRDAĞ GÖBEK RAKISI 70 CL', 'price' => 3500],

            ['tr' => 'KULÜP RAKI DELÜKS 35 CL', 'en' => 'KULÜP RAKI DELUXE 35 CL', 'price' => 1900],
            ['tr' => 'KULÜP RAKI DELÜKS 70 CL', 'en' => 'KULÜP RAKI DELUXE 70 CL', 'price' => 3300],

            ['tr' => 'Efe Gold TEK', 'en' => 'Efe Gold SINGLE', 'price' => 350],
            ['tr' => 'Efe Gold DUBLE', 'en' => 'Efe Gold DOUBLE', 'price' => 500],
            ['tr' => 'Efe Gold 35 cl', 'en' => 'Efe Gold 35 cl', 'price' => 1900],
            ['tr' => 'Efe Gold 50 cl', 'en' => 'Efe Gold 50 cl', 'price' => 2500],
            ['tr' => 'Efe Gold 70 cl', 'en' => 'Efe Gold 70 cl', 'price' => 3300],

            ['tr' => 'Beylerbeyi Göbek 35 cl', 'en' => 'Beylerbeyi Göbek 35 cl', 'price' => 2100],
            ['tr' => 'Beylerbeyi Göbek 50 cl', 'en' => 'Beylerbeyi Göbek 50 cl', 'price' => 2800],
            ['tr' => 'Beylerbeyi Göbek 70 cl', 'en' => 'Beylerbeyi Göbek 70 cl', 'price' => 3700],
        ]);
    }

    private function seedItems($parentId, $itemsArray, $note = null)
    {
        foreach($itemsArray as $i => $item) {
            $desc = $item['desc'] ?? null;
            if ($note) {
                $trNote = is_array($note) ? ($note['tr'] ?? $note) : $note;
                $enNote = is_array($note) ? ($note['en'] ?? $note) : $note;

                $desc = [
                    'tr' => (($desc && isset($desc['tr'])) ? $desc['tr'] . "\n" : "") . $trNote,
                    'en' => (($desc && isset($desc['en'])) ? $desc['en'] . "\n" : "") . $enNote,
                ];
            }

            MenuItem::create([
                'category_id' => $parentId,
                'name' => ['en' => $item['en'], 'tr' => $item['tr']],
                'slug' => ['en' => Str::slug($item['en']), 'tr' => Str::slug($item['tr'])],
                'price' => $item['price'],
                'description' => $desc,
                'is_active' => true,
                'order_column' => $i + 1,
            ]);
        }
    }
}
