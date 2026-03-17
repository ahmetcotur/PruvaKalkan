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

        // Clean up categories under "İçecek Menüsü"
        $oldSubCats = Category::where('parent_id', $drinkCat->id)->get();
        foreach ($oldSubCats as $cat) {
            $cat->delete();
        }

        // 1. SOFT DRINKS / SOĞUK İÇECEKLER
        $softDrinks = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Soft Drinks', 'tr' => 'Soğuk İçecekler'],
            'order_column' => 1,
            'is_active' => true
        ]);
        $this->seedItems($softDrinks->id, [
            ['tr' => 'Su 1 Litre', 'en' => 'Water 1 Litre', 'price' => 100],
            ['tr' => 'Soda 1 Litre', 'en' => 'Mineral Water 1 Litre', 'price' => 150],
            ['tr' => 'Küçük Soda', 'en' => 'Small Mineral Water', 'price' => 60],
            ['tr' => 'Tonik', 'en' => 'Tonic Water', 'price' => 150],
            ['tr' => 'Kola / Fanta / Sprite / Cola Zero', 'en' => 'Cola / Fanta / Sprite / Cola Zero', 'price' => 150],
            ['tr' => 'Ice Tea', 'en' => 'Ice Tea', 'price' => 150],
            ['tr' => 'Meyve Suları (Şeftali, Ananas, Vişne, Portakal)', 'en' => 'Fruit Juices (Peach, Pineapple, Cherry, Orange)', 'price' => 150],
            ['tr' => 'Milkshakeler (Vanilya, Çikolata, Muz)', 'en' => 'Milkshakes (Vanilla, Chocolate, Banana)', 'price' => 300],
            ['tr' => 'Ev Yapımı Limonata', 'en' => 'Homemade Lemonade', 'price' => 250],
            ['tr' => 'Taze Portakal Suyu', 'en' => 'Fresh Orange Juice', 'price' => 250],
            ['tr' => 'Red Bull', 'en' => 'Red Bull', 'price' => 200],
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
            ['tr' => 'Cappuccino', 'en' => 'Cappuccino', 'price' => 180],
            ['tr' => 'Latte', 'en' => 'Latte', 'price' => 180],
            ['tr' => 'Iced Coffee', 'en' => 'Iced Coffee', 'price' => 300],
            ['tr' => 'Espresso', 'en' => 'Espresso', 'price' => 140],
            ['tr' => 'Double Espresso', 'en' => 'Double Espresso', 'price' => 180],
            ['tr' => 'Türk Kahvesi', 'en' => 'Turkish Coffee', 'price' => 130],
            ['tr' => 'Irish Coffee', 'en' => 'Irish Coffee', 'price' => 500],
            ['tr' => 'Demleme Çay', 'en' => 'Turkish Tea', 'price' => 50],
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
            ['tr' => 'Efes 50 CL', 'en' => 'Efes 50 CL', 'price' => 250],
            ['tr' => 'Tuborg 50 CL', 'en' => 'Tuborg 50 CL', 'price' => 280],
            ['tr' => 'Corona / Miller / Becks / Apple Cider', 'en' => 'Corona / Miller / Becks / Apple Cider', 'price' => 340],
            ['tr' => 'Carlsberg', 'en' => 'Carlsberg', 'price' => 340],
            ['tr' => 'Bomonti Filtresiz', 'en' => 'Bomonti Unfiltered', 'price' => 320],
        ]);

        // 4. IMPORTS / İTHAL İÇKİLER
        $imports = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Imports', 'tr' => 'İthal İçkiler'],
            'order_column' => 4,
            'is_active' => true
        ]);
        $this->seedItems($imports->id, [
            ['tr' => 'Bacardi', 'en' => 'Bacardi', 'price' => 450],
            ['tr' => 'Captain Morgan', 'en' => 'Captain Morgan', 'price' => 400],
            ['tr' => 'Malibu', 'en' => 'Malibu', 'price' => 300],
            ['tr' => 'Baileys', 'en' => 'Baileys', 'price' => 300],
            ['tr' => 'Tia Maria', 'en' => 'Tia Maria', 'price' => 250],
            ['tr' => 'Archers', 'en' => 'Archers', 'price' => 300],
            ['tr' => 'Cointreau', 'en' => 'Cointreau', 'price' => 450],
            ['tr' => 'Disaronno Amaretto', 'en' => 'Disaronno Amaretto', 'price' => 350],
            ['tr' => 'Yerli Brendi', 'en' => 'Local Brandy', 'price' => 350],
            ['tr' => 'Metaxa', 'en' => 'Metaxa', 'price' => 500],
        ]);

        // 5. WHISKIES / VİSKİLER
        $whiskies = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Whiskies', 'tr' => 'Viskiler'],
            'order_column' => 5,
            'is_active' => true
        ]);
        $this->seedItems($whiskies->id, [
            ['tr' => 'Chivas Regal 12', 'en' => 'Chivas Regal 12', 'price' => 550],
            ['tr' => 'Chivas Regal 18', 'en' => 'Chivas Regal 18', 'price' => 950],
            ['tr' => 'Jack Daniels', 'en' => 'Jack Daniels', 'price' => 450],
            ['tr' => 'Johnnie Walker Red Label', 'en' => 'Johnnie Walker Red Label', 'price' => 400],
            ['tr' => 'Johnnie Walker Black Label', 'en' => 'Johnnie Walker Black Label', 'price' => 480],
            ['tr' => 'Grants', 'en' => 'Grants', 'price' => 400],
            ['tr' => 'J&B', 'en' => 'J&B', 'price' => 400],
            ['tr' => 'Jameson', 'en' => 'Jameson', 'price' => 450],
            ['tr' => 'Monkey Shoulder', 'en' => 'Monkey Shoulder', 'price' => 600],
            ['tr' => 'Jim Beam', 'en' => 'Jim Beam', 'price' => 400],
            ['tr' => 'Talisker 10', 'en' => 'Talisker 10', 'price' => 700],
            ['tr' => 'The Glenlivet', 'en' => 'The Glenlivet', 'price' => 650],
        ]);

        // 6. VODKA / VODKALAR
        $vodkas = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Vodka', 'tr' => 'Vodkalar'],
            'order_column' => 6,
            'is_active' => true
        ]);
        $this->seedItems($vodkas->id, [
            ['tr' => 'Absolut', 'en' => 'Absolut', 'price' => 400],
            ['tr' => 'Smirnoff', 'en' => 'Smirnoff', 'price' => 350],
            ['tr' => 'Belvedere', 'en' => 'Belvedere', 'price' => 650],
            ['tr' => 'Grey Goose', 'en' => 'Grey Goose', 'price' => 700],
        ]);

        // 7. TEQUILA / TEKİLA
        $tequila = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Tequila', 'tr' => 'Tekila'],
            'order_column' => 7,
            'is_active' => true
        ]);
        $this->seedItems($tequila->id, [
            ['tr' => 'Olmeca Silver', 'en' => 'Olmeca Silver', 'price' => 350],
            ['tr' => 'Olmeca Gold', 'en' => 'Olmeca Gold', 'price' => 380],
            ['tr' => 'Avion', 'en' => 'Avion', 'price' => 600],
        ]);

        // 8. GIN / CİN
        $gin = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Gin', 'tr' => 'Cin'],
            'order_column' => 8,
            'is_active' => true
        ]);
        $this->seedItems($gin->id, [
            ['tr' => 'Beefeater', 'en' => 'Beefeater', 'price' => 400],
            ['tr' => 'Bombay Sapphire', 'en' => 'Bombay Sapphire', 'price' => 450],
            ['tr' => 'Tanqueray', 'en' => 'Tanqueray', 'price' => 450],
            ['tr' => 'Hendricks', 'en' => 'Hendricks', 'price' => 650],
            ['tr' => 'Monkey 47', 'en' => 'Monkey 47', 'price' => 700],
            ['tr' => 'Gordon’s Pink', 'en' => 'Gordon’s Pink', 'price' => 400],
        ]);

        // 9. COCKTAILS / KOKTEYLLER
        $cocktails = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Cocktails', 'tr' => 'Kokteyller'],
            'order_column' => 9,
            'is_active' => true
        ]);
        $this->seedItems($cocktails->id, [
            ['tr' => 'Aperol Spritz', 'en' => 'Aperol Spritz', 'price' => 500],
            ['tr' => 'Negroni', 'en' => 'Negroni', 'price' => 500],
            ['tr' => 'Margarita', 'en' => 'Margarita', 'price' => 500],
            ['tr' => 'Mojito', 'en' => 'Mojito', 'price' => 500],
            ['tr' => 'Espresso Martini', 'en' => 'Espresso Martini', 'price' => 500],
            ['tr' => 'Old Fashioned', 'en' => 'Old Fashioned', 'price' => 550],
            ['tr' => 'Pornstar Martini', 'en' => 'Pornstar Martini', 'price' => 550],
            ['tr' => 'Cosmopolitan', 'en' => 'Cosmopolitan', 'price' => 500],
            ['tr' => 'Lynchburg Lemonade', 'en' => 'Lynchburg Lemonade', 'price' => 550],
            ['tr' => 'Long Island Ice Tea', 'en' => 'Long Island Ice Tea', 'price' => 600],
            ['tr' => 'Whiskey Sour', 'en' => 'Whiskey Sour', 'price' => 500],
            ['tr' => 'Pina Colada', 'en' => 'Pina Colada', 'price' => 550],
            ['tr' => 'Moscow Mule', 'en' => 'Moscow Mule', 'price' => 500],
        ]);

        // 10. KIRMIZI ŞARAPLAR / RED WINES
        $redWines = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Red Wines', 'tr' => 'Kırmızı Şaraplar'],
            'order_column' => 10,
            'is_active' => true
        ]);
        $this->seedItems($redWines->id, [
            [
                'tr' => 'Ev Şarabı', 'en' => 'House Wine',
                'desc' => ['tr' => 'Yakut kırmızısı renkte, hafif içimli ve zarif alt notalara sahip bir şaraptır.', 'en' => 'A ruby red wine with a light palate and subtle undertones.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 300],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 950],
                ]
            ],
            [
                'tr' => 'DLC Cabernet Sauvignon – Merlot', 'en' => 'DLC Cabernet Sauvignon – Merlot',
                'desc' => ['tr' => 'Dengeli, zarif ve keyifli bir kırmızı şaraptır.', 'en' => 'An elegant, balanced, and enjoyable red wine.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 450],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 1600],
                ]
            ],
            [
                'tr' => 'DLC Shiraz', 'en' => 'DLC Shiraz', 'price' => 1800,
                'desc' => ['tr' => 'Siyah meyve aromalarına tütün ve baharat karakteri eşlik eder.', 'en' => 'Black fruit aromas are supported by tobacco and spice notes.']
            ],
            [
                'tr' => 'Anfora Shiraz', 'en' => 'Anfora Shiraz', 'price' => 2000,
                'desc' => ['tr' => 'Koyu meyve, baharat ve hafif meşe notalarıyla dengeli yapıya sahiptir.', 'en' => 'Produced from carefully selected Shiraz grapes with its balanced structure and smooth tannins.']
            ],
            [
                'tr' => 'Anfora Merlot', 'en' => 'Anfora Merlot', 'price' => 2000,
                'desc' => ['tr' => 'Kırmızı meyve aromaları, hafif baharat ve meşe notalarıyla dengeli bir yapı sunar.', 'en' => 'Produced from Merlot grapes with a balanced structure with red fruit aromas, subtle spice, and oak notes.']
            ],
            [
                'tr' => 'Artı Cabernet Sauvignon – Merlot', 'en' => 'Artı Cabernet Sauvignon – Merlot', 'price' => 1900,
                'desc' => ['tr' => 'Eğlenceli, zarif ve dengeli bir şaraptır.', 'en' => 'A lively, elegant, and well-balanced wine.']
            ],
            [
                'tr' => 'Kav Boğazkere', 'en' => 'Kav Boğazkere', 'price' => 2200,
                'desc' => ['tr' => 'Baharat, deri, tütün, pekmez ve meyve özlerini çağrıştıran aroma ve tatlara sahiptir.', 'en' => 'Lively and dark purple in colour, with aromas and flavours reminiscent of spice, leather, tobacco, molasses, and fruit essence.']
            ],
            [
                'tr' => 'Premium Sarafin Meritage', 'en' => 'Premium Sarafin Meritage', 'price' => 5000,
                'desc' => ['tr' => 'Koyu bordo rengi ve Fransız meşe fıçıda olgunlaştırılmış yapısıyla güçlü ve sofistike bir içim sunar.', 'en' => 'With its deep burgundy colour and French oak ageing, it offers a rich and sophisticated taste.']
            ],
        ]);

        // 11. BEYAZ ŞARAPLAR / WHITE WINES
        $whiteWines = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'White Wines', 'tr' => 'Beyaz Şaraplar'],
            'order_column' => 11,
            'is_active' => true
        ]);
        $this->seedItems($whiteWines->id, [
            [
                'tr' => 'Ev Şarabı', 'en' => 'House Wine',
                'desc' => ['tr' => 'Hafif, ferah ve zarif çiçeksi karaktere sahip bir beyaz şaraptır.', 'en' => 'A light, airy, and fragrant white wine with hints of elderflower and citrus.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 300],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 950],
                ]
            ],
            [
                'tr' => 'Hayal Sauvignon Blanc', 'en' => 'Hayal Sauvignon Blanc',
                'desc' => ['tr' => 'Yumuşak içimli ve ferahlatıcı bir beyaz şaraptır.', 'en' => 'A smooth and refreshing white wine with rich citrus and fruit aromas.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 400],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 1300],
                ]
            ],
            [
                'tr' => 'Anfora Chardonnay', 'en' => 'Anfora Chardonnay', 'price' => 2000,
                'desc' => ['tr' => 'Canlı, yuvarlak ve dengeli asiditeye sahip bir şaraptır.', 'en' => 'A lively, round, and well-balanced wine.']
            ],
            [
                'tr' => 'Premium Sarafin Sauvignon Blanc', 'en' => 'Premium Sarafin Sauvignon Blanc', 'price' => 3000,
                'desc' => ['tr' => 'Yumuşak içimli, meyvemsi ve dengeli yapısıyla öne çıkan seçkin bir beyaz şaraptır.', 'en' => 'A smooth, fruity, and beautifully balanced premium white wine.']
            ],
            [
                'tr' => 'Lamberti Pinot Grigio Delle Venezie', 'en' => 'Lamberti Pinot Grigio Delle Venezie',
                'desc' => ['tr' => 'Taze ve uzun bitişli bir şaraptır.', 'en' => 'Fresh and vibrant, with notes of white flowers and pear, finishing long and clean.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 400],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 1800],
                ]
            ],
            [
                'tr' => 'Kav Narince', 'en' => 'Kav Narince', 'price' => 2200,
                'desc' => ['tr' => 'Kendine has aromatik yapısı sayesinde tek başına içimi de oldukça keyiflidir.', 'en' => 'Its distinctive aromatic profile also makes it delightful on its own.']
            ],
            [
                'tr' => 'Artı Sauvignon Blanc', 'en' => 'Artı Sauvignon Blanc', 'price' => 1900,
                'desc' => ['tr' => 'Dengeli ve canlı asiditeye sahip bir şaraptır.', 'en' => 'Produced from carefully selected Sauvignon Blanc grapes showing fresh, balanced structure and lively acidity.']
            ],
            [
                'tr' => 'DLC Sultaniye – Emir', 'en' => 'DLC Sultaniye – Emir',
                'desc' => ['tr' => 'Narenciye ve beyaz meyve notalarıyla taze, dengeli ve keyifli bir içim sunar.', 'en' => 'Produced from a blend of Sultaniye and Emir grapes grown in the Aegean region and Cappadocia.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 500],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 1900],
                ]
            ],
        ]);

        // 12. ROSE ŞARAPLAR / ROSE WINES
        $roseWines = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Rose Wines', 'tr' => 'Rose Şaraplar'],
            'order_column' => 12,
            'is_active' => true
        ]);
        $this->seedItems($roseWines->id, [
            [
                'tr' => 'Ev Şarabı', 'en' => 'House Wine',
                'desc' => ['tr' => 'Meyvemsi aromalara sahip, ferah, yumuşak ve canlı içimli bir roze şaraptır.', 'en' => 'A refreshing, smooth, and crisp rosé wine with fruity aromas.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 300],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 950],
                ]
            ],
            [
                'tr' => 'Verano Blush Rosé', 'en' => 'Verano Blush Rosé',
                'desc' => ['tr' => 'Canlı asiditesiyle aperitif olarak da ya da deniz ürünleri, tavuk ve makarna yanında ideal bir seçimdir.', 'en' => 'Crafted from rare Kalecik grapes, this rosé offers delicate floral notes with aromas of cherry, raspberry, and ripe fruits.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 450],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 1800],
                ]
            ],
            [
                'tr' => 'Kızılaalan', 'en' => 'Kızılaalan',
                'desc' => ['tr' => 'Meyvemsi ve zarif bir yapıya sahiptir.', 'en' => 'Balık ve makarna çeşitleriyle iyi uyum sağlar.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 500],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 2100],
                ]
            ],
            [
                'tr' => 'Hayal Rosé', 'en' => 'Hayal Rosé',
                'desc' => ['tr' => 'Hafif, ferah ve meyvemsi karakteriyle gün boyu keyifle tercih edilebilecek zarif bir roze şaraptır.', 'en' => 'A light, refreshing, and fruity rosé wine that is elegant and easy to enjoy throughout the day.'],
                'variations' => [
                    ['name' => ['tr' => 'Kadeh', 'en' => 'Glass'], 'price' => 400],
                    ['name' => ['tr' => 'Şişe', 'en' => 'Bottle'], 'price' => 1300],
                ]
            ],
        ]);

        // 13. RAKILAR / TURKISH RAKIS
        $rakis = Category::create([
            'parent_id' => $drinkCat->id,
            'name' => ['en' => 'Turkish Rakis', 'tr' => 'Rakılar'],
            'order_column' => 13,
            'is_active' => true
        ]);
        $this->seedItems($rakis->id, [
            [
                'tr' => 'Yeni Rakı Yeni Seri', 'en' => 'Yeni Rakı Yeni Seri',
                'variations' => [
                    ['name' => ['tr' => 'Tek', 'en' => 'Single'], 'price' => 200],
                    ['name' => ['tr' => 'Duble', 'en' => 'Double'], 'price' => 350],
                    ['name' => ['tr' => '35 CL', 'en' => '35 CL'], 'price' => 1500],
                    ['name' => ['tr' => '70 CL', 'en' => '70 CL'], 'price' => 2800],
                ]
            ],
            [
                'tr' => 'Tekirdağ Altın Seri', 'en' => 'Tekirdağ Altın Seri',
                'variations' => [
                    ['name' => ['tr' => 'Tek', 'en' => 'Single'], 'price' => 225],
                    ['name' => ['tr' => 'Duble', 'en' => 'Double'], 'price' => 450],
                    ['name' => ['tr' => '35 CL', 'en' => '35 CL'], 'price' => 1700],
                    ['name' => ['tr' => '70 CL', 'en' => '70 CL'], 'price' => 3200],
                ]
            ],
            [
                'tr' => 'Beylerbeyi Göbek Rakısı', 'en' => 'Beylerbeyi Göbek Rakısı',
                'variations' => [
                    ['name' => ['tr' => 'Tek', 'en' => 'Single'], 'price' => 250],
                    ['name' => ['tr' => 'Duble', 'en' => 'Double'], 'price' => 500],
                    ['name' => ['tr' => '35 CL', 'en' => '35 CL'], 'price' => 2000],
                    ['name' => ['tr' => '70 CL', 'en' => '70 CL'], 'price' => 3800],
                ]
            ],
        ]);
    }

    private function seedItems($parentId, $itemsArray)
    {
        foreach($itemsArray as $i => $item) {
            MenuItem::create([
                'category_id' => $parentId,
                'name' => ['en' => $item['en'], 'tr' => $item['tr']],
                'slug' => ['en' => Str::slug($item['en']), 'tr' => Str::slug($item['tr'])],
                'price' => $item['price'] ?? null,
                'variations' => $item['variations'] ?? null,
                'description' => $item['desc'] ?? null,
                'is_active' => true,
                'order_column' => $i + 1,
            ]);
        }
    }
}
