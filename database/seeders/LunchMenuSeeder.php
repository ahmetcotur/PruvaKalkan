<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Support\Str;

class LunchMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Find existing "Lunch Menüsü"
        $lunchCat = Category::where('name->tr', 'Lunch Menüsü')
            ->orWhere('name->en', 'Lunch Menu')
            ->first();

        if (!$lunchCat) {
            $lunchCat = Category::create([
                'name' => ['en' => 'Lunch Menu', 'tr' => 'Lunch Menüsü'],
                'slug' => ['en' => 'lunch-menu', 'tr' => 'lunch-menusu'],
                'description' => ['en' => 'Delicious lunch options for a perfect day.', 'tr' => 'Mükemmel bir gün için lezzetli öğle yemeği seçenekleri.'],
                'is_active' => true,
                'order_column' => 1,
            ]);
        }

        // Clean up existing subcategories under "Lunch Menüsü"
        $subCatNames = [
            'Aperatifler', 'Salatalar', 'Dürümler', 'Fajitalar', 'Makarnalar', 'Burgerler', 'Ana Yemekler', 'Tatlılar'
        ];

        foreach ($subCatNames as $name) {
            $cat = Category::where('parent_id', $lunchCat->id)
                ->where('name->tr', $name)
                ->first();
            if ($cat) {
                MenuItem::where('category_id', $cat->id)->delete();
                $cat->delete();
            }
        }

        // 1. APERATİFLER (Appetizers)
        $appetizers = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Appetizers', 'tr' => 'Aperatifler'],
            'order_column' => 1,
            'is_active' => true
        ]);
        $this->seedItems($appetizers->id, [
            [
                'tr' => 'Trüf Yağlı Parmesanlı Patates', 
                'en' => 'Truffle Parmesan Fries', 
                'price' => 300, 
                'desc' => ['tr' => 'Trüf yağı, parmesan peyniri ve patates.', 'en' => 'Truffle oil, parmesan cheese and potatoes.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Chicken Fingers', 
                'en' => 'Chicken Fingers', 
                'price' => 700, 
                'desc' => ['tr' => 'Panelenmiş tavuk dilimleri, kajun baharatlı patates ile servis edilir.', 'en' => 'Breaded chicken strips served with cajun fries.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Buffalo Wings', 
                'en' => 'Buffalo Wings', 
                'price' => 1000, 
                'desc' => ['tr' => 'Acılı buffalo soslu kızarmış tavuk kanatları.', 'en' => 'Fried chicken wings with spicy buffalo sauce.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Misket Falafel', 
                'en' => 'Falafel Balls', 
                'price' => 750, 
                'desc' => ['tr' => 'Falafel topları, mevsim yeşillikleri ve yoğurt sos ile servis edilir.', 'en' => 'Falafel balls, served with seasonal greens and yogurt sauce.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Bira Tabağı', 
                'en' => 'Beer Plate', 
                'price' => 1100, 
                'desc' => ['tr' => 'Mozzarella stick, soğan halkası, sosis, cips ve tavuk dilimleri.', 'en' => 'Mozzarella sticks, onion rings, sausage, crisps and chicken strips.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Kalamar Tava', 
                'en' => 'Fried Calamari', 
                'price' => 760, 
                'desc' => ['tr' => 'Çıtır kalamar, mevsim yeşillikleri ve tarator sos ile servis edilir.', 'en' => 'Served with seasonal greens and tarator sauce.'],
                'allergens' => ['tr' => 'Gluten, Deniz Ürünleri, Süt', 'en' => 'Gluten, Seafood, Milk']
            ],
            [
                'tr' => 'Tereyağlı Sarımsaklı Karides', 
                'en' => 'Butter Garlic Shrimp', 
                'price' => 760, 
                'desc' => ['tr' => 'Tereyağı, sarımsak, limon ve kuru domates ile hazırlanır.', 'en' => 'Prepared with butter, garlic, shrimp, lemon and sun-dried tomatoes.'],
                'allergens' => ['tr' => 'Deniz Ürünleri, Süt', 'en' => 'Seafood, Milk']
            ],
            [
                'tr' => 'Kaşarlı Mantar', 
                'en' => 'Mushrooms with Kashar Cheese', 
                'price' => 360, 
                'desc' => ['tr' => 'Mantar, kaşar, sarımsak ve tereyağı.', 'en' => 'Mushrooms, kashar cheese, garlic and butter.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Izgara Hellim', 
                'en' => 'Grilled Halloumi', 
                'price' => 400, 
                'desc' => ['tr' => 'Hellim peyniri, köz biber, cherry domates ve tereyağı ile servis edilir.', 'en' => 'Grilled halloumi, roasted pepper, cherry tomatoes served with butter.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Tavuk Nachos', 
                'en' => 'Chicken Nachos', 
                'price' => 500, 
                'desc' => ['tr' => 'Mısır tortilla, tavuk dilimleri, cheddar peyniri, renkli biberler ve mısır ile.', 'en' => 'Corn tortilla, chicken breast, cheddar cheese, bell peppers and corn.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Et Nachos', 
                'en' => 'Beef Nachos', 
                'price' => 600, 
                'desc' => ['tr' => 'Mısır tortilla, dana bonfile, cheddar peyniri, renkli biberler ve mısır ile.', 'en' => 'Corn tortilla, beef tenderloin, cheddar cheese, bell peppers and corn.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
        ]);

        // 2. SALATALAR (Salads)
        $salads = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Salads', 'tr' => 'Salatalar'],
            'order_column' => 2,
            'is_active' => true
        ]);
        $this->seedItems($salads->id, [
            [
                'tr' => 'Roka Salatası', 
                'en' => 'Rocket Salad', 
                'price' => 500, 
                'desc' => ['tr' => 'Roka, ezine peyniri, cherry domates, ceviz ve yeşil elmalı sos ile hazırlanır.', 'en' => 'Prepared with rocket, cherry tomatoes, ezine cheese, walnut, green apple and garlic dressing.'],
                'allergens' => ['tr' => 'Süt, Kuruyemiş', 'en' => 'Milk, Nuts']
            ],
            [
                'tr' => 'Greek Salata', 
                'en' => 'Greek Salad', 
                'price' => 500, 
                'desc' => ['tr' => 'Mor soğan, salatalık, zeytin, biber, kroton ve peynir ile hazırlanır.', 'en' => 'Prepared with red onion, cucumber, olives, peppers, croutons, and cheese.'],
                'allergens' => ['tr' => 'Süt, Gluten', 'en' => 'Milk, Gluten']
            ],
            [
                'tr' => 'Ton Balıklı Salata', 
                'en' => 'Tuna Salad', 
                'price' => 600, 
                'desc' => ['tr' => 'Ton balığı, mısır, mevsim yeşillikleri, cherry domates ile servis edilir.', 'en' => 'Tuna is served with corn, seasonal greens, and cherry tomatoes.'],
                'allergens' => ['tr' => 'Balık', 'en' => 'Fish']
            ],
            [
                'tr' => 'Sezar Salata', 
                'en' => 'Caesar Salad', 
                'price' => 550, 
                'desc' => ['tr' => 'Izgara tavuk, kuru domates, kroton, marul, sezar sos.', 'en' => 'Grilled chicken, sun-dried tomatoes, croutons, lettuce, Caesar dressing.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Dana Bonfile Salata', 
                'en' => 'Beef Tenderloin Salad', 
                'price' => 720, 
                'desc' => ['tr' => 'Dana bonfile, mevsim yeşillikleri, cherry domates ile servis edilir.', 'en' => 'Beef tenderloin is served with seasonal greens and cherry tomatoes.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
        ]);

        // 3. BURGERLER (Burgers)
        $burgers = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Burgers', 'tr' => 'Burgerler'],
            'order_column' => 3,
            'is_active' => true
        ]);
        $this->seedItems($burgers->id, [
            [
                'tr' => 'Beef Burger', 
                'en' => 'Beef Burger', 
                'price' => 700, 
                'desc' => ['tr' => '180g dana burger, marul, domates, turşu ve patates kızartması ile.', 'en' => '180g beef patty, lettuce, tomato, pickles served with french fries.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Cheese Burger', 
                'en' => 'Cheese Burger', 
                'price' => 750, 
                'desc' => ['tr' => '180g dana burger, cheddar peyniri ve patates kızartması ile.', 'en' => '180g beef patty, cheddar cheese served with french fries.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Mantar Burger', 
                'en' => 'Mushroom Burger', 
                'price' => 800, 
                'desc' => ['tr' => 'Dana burger, sote mantar, soğan karamelize ve cheddar ile.', 'en' => 'Beef patty, sautéed mushrooms, caramelized onions and cheddar.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Chicken Burger', 
                'en' => 'Chicken Burger', 
                'price' => 850, 
                'desc' => ['tr' => 'Çıtır tavuk göğsü, marul, domates, turşu ve patates kızartması ile.', 'en' => 'Crispy chicken breast, lettuce, tomato, pickles served with french fries.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
        ]);

        // 4. MAKARNALAR (Pastas)
        $pastas = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Pastas', 'tr' => 'Makarnalar'],
            'order_column' => 4,
            'is_active' => true
        ]);
        $this->seedItems($pastas->id, [
            [
                'tr' => 'Biftekli Penne', 
                'en' => 'Beef Penne', 
                'price' => 650, 
                'desc' => ['tr' => 'Bonfile parçaları, cherry domates, krema ve domates sos.', 'en' => 'Beef tenderloin pieces, cherry tomatoes, cream and tomatoes sauce.'],
                'allergens' => ['tr' => 'Gluten, Süt, Yumurta', 'en' => 'Gluten, Milk, Egg']
            ],
            [
                'tr' => 'Arrabbiata', 
                'en' => 'Arrabbiata', 
                'price' => 500, 
                'desc' => ['tr' => 'Acılı domates sos, cherry domates ve siyah zeytin.', 'en' => 'Spicy tomato sauce, cherry tomatoes and black olives.'],
                'allergens' => ['tr' => 'Gluten, Süt, Yumurta', 'en' => 'Gluten, Milk, Egg']
            ],
            [
                'tr' => 'Ragu Spaghetti', 
                'en' => 'Ragu Spaghetti', 
                'price' => 600, 
                'desc' => ['tr' => 'Bolognese sos ve parmesan peyniri.', 'en' => 'Bolognese sauce and parmesan cheese.'],
                'allergens' => ['tr' => 'Gluten, Süt, Yumurta', 'en' => 'Gluten, Milk, Egg']
            ],
            [
                'tr' => 'Deniz Ürünlü Tagliatelle', 
                'en' => 'Seafood Tagliatelle', 
                'price' => 800, 
                'desc' => ['tr' => 'Kalamar, karides ve midye ile krema soslu deniz ürünleri.', 'en' => 'Seafood with shrimp, calamari and mussels in cream sauce.'],
                'allergens' => ['tr' => 'Gluten, Deniz Ürünleri, Süt, Yumurta', 'en' => 'Gluten, Seafood, Milk, Egg']
            ],
            [
                'tr' => 'Fettuccine Alfredo', 
                'en' => 'Fettuccine Alfredo', 
                'price' => 550, 
                'desc' => ['tr' => 'Tavuk, mantar ve krema sos ile hazırlanır.', 'en' => 'Prepared with chicken, mushrooms and cream sauce.'],
                'allergens' => ['tr' => 'Gluten, Süt, Yumurta', 'en' => 'Gluten, Milk, Egg']
            ],
        ]);

        // 5. ANA YEMEKLER (Main Courses)
        $mainCourses = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Main Courses', 'tr' => 'Ana Yemekler'],
            'order_column' => 5,
            'is_active' => true
        ]);
        $this->seedItems($mainCourses->id, [
            [
                'tr' => 'Izgara Köfte', 
                'en' => 'Grilled Meatballs', 
                'price' => 1000, 
                'desc' => ['tr' => 'Dana kıyma ve soğan. Köz biber, köz domates, pilav ve cips ile servis edilir.', 'en' => 'Minced beef and onion. Served w/ roasted pepper, tomato, rice and fries.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Kuzu Şiş', 
                'en' => 'Lamb Shish', 
                'price' => 1350, 
                'desc' => ['tr' => 'Marine edilmiş kuzu eti. Köz biber, köz domates, pilav ve patates cips ile servis edilir.', 'en' => 'Marinated lamb served with roasted pepper, roasted tomato, rice and fries.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Tavuk Şinitzel', 
                'en' => 'Chicken Schnitzel', 
                'price' => 900, 
                'desc' => ['tr' => 'Pane kaplı tavuk göğsü, patates cips ile servis edilir.', 'en' => 'Breaded chicken breast served with fries.'],
                'allergens' => ['tr' => 'Gluten, Süt, Yumurta', 'en' => 'Gluten, Milk, Egg']
            ],
            [
                'tr' => 'Tavuk Şiş', 
                'en' => 'Chicken Shish', 
                'price' => 800, 
                'desc' => ['tr' => 'Tavuk bonfile dilimleri. Köz biber, köz domates, pilav ve patates cips ile servis edilir.', 'en' => 'Chicken fillet slices served with roasted pepper, roasted tomato, rice and fries.'],
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Tatlı Ekşi Tavuk', 
                'en' => 'Sweet & Sour Chicken', 
                'price' => 990, 
                'desc' => ['tr' => 'Jülyen tavuk dilimleri, biberler ve soğan ile hazırlanır. Pilav, cips ile servis edilir.', 'en' => 'Prepared with julienne chicken, coloured peppers and onion; served with rice and fries.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
        ]);

        // 6. DÜRÜMLER (Wraps)
        $wraps = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Wraps', 'tr' => 'Dürümler'],
            'order_column' => 6,
            'is_active' => true
        ]);
        $this->seedItems($wraps->id, [
            [
                'tr' => 'Et Dürüm', 
                'en' => 'Beef Wrap', 
                'price' => 700, 
                'desc' => ['tr' => 'Jülyen bonfile, biber, soğan ve mozzarella ile hazırlanır.', 'en' => 'Prepared with julienne beef tenderloin, peppers, onion and mozzarella.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Tavuk Dürüm', 
                'en' => 'Chicken Wrap', 
                'price' => 600, 
                'desc' => ['tr' => 'Jülyen tavuk, biber, soğan ve mozzarella ile hazırlanır.', 'en' => 'Prepared with julienne chicken, peppers, onion and mozzarella.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
        ]);

        // 7. FAJİTALAR (Fajitas)
        $fajitas = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Fajitas', 'tr' => 'Fajitalar'],
            'order_column' => 7,
            'is_active' => true
        ]);
        $this->seedItems($fajitas->id, [
            [
                'tr' => 'Et Fajita', 
                'en' => 'Beef Fajita', 
                'price' => 1250, 
                'desc' => ['tr' => 'Dana eti, tortilla, renkli biberler ve soğan ile hazırlanır.', 'en' => 'Prepared with beef tenderloin, tortilla, bell peppers and onion.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Tavuk Fajita', 
                'en' => 'Chicken Fajita', 
                'price' => 1100, 
                'desc' => ['tr' => 'Tavuk göğsü, tortilla, renkli biberler ve soğan ile hazırlanır.', 'en' => 'Prepared with chicken, tortilla, bell peppers and onion.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Vejetaryen Fajita', 
                'en' => 'Vegetarian Fajita', 
                'price' => 950, 
                'desc' => ['tr' => 'Tortilla, renkli biberler, mevsim sebzeleri ve soğan ile hazırlanır.', 'en' => 'Prepared with tortilla, bell peppers, seasonal vegetables and onion.'],
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
        ]);

        // 8. TATLILAR (Desserts)
        $desserts = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Desserts', 'tr' => 'Tatlılar'],
            'order_column' => 8,
            'is_active' => true
        ]);
        $this->seedItems($desserts->id, [
            [
                'tr' => 'Havuç Dilimi Baklava', 
                'en' => 'Carrot Slice Baklava', 
                'price' => 500, 
                'desc' => ['tr' => 'Baklava hamuru, antep fıstığı, şeker şurubu ve tereyağı ile paketlenir; dondurma ile servis edilir.', 'en' => 'Phyllo dough packed with pistachios, sugar syrup and butter; served with ice cream.'],
                'allergens' => ['tr' => 'Gluten, Süt, Kuruyemiş', 'en' => 'Gluten, Milk, Nuts']
            ],
            [
                'tr' => 'İrmik Helvası', 
                'en' => 'Semolina Halva', 
                'price' => 350, 
                'desc' => ['tr' => 'İrmik, süt, şeker, margarin ve antep fıstığı; dondurma ile.', 'en' => 'Semolina, milk, sugar, margarine and pistachios; with ice cream.'],
                'allergens' => ['tr' => 'Gluten, Süt, Kuruyemiş', 'en' => 'Gluten, Milk, Nuts']
            ],
            [
                'tr' => 'Meyve Tabağı', 
                'en' => 'Fruit Platter', 
                'price' => 300, 
                'desc' => ['tr' => 'Mevsim meyveleri.', 'en' => 'Seasonal fruits.']
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
                'price' => $item['price'],
                'description' => $item['desc'] ?? null,
                'allergen_info' => $item['allergens'] ?? null,
                'is_active' => true,
                'order_column' => $i + 1,
            ]);
        }
    }
}
