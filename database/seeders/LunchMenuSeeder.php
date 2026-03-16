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
                'en' => 'Truffle Oil & Parmesan Fries', 
                'price' => 300, 
                'desc' => ['tr' => 'Trüf yağı, parmesan peyniri, patates.', 'en' => 'Truffle oil, parmesan cheese, potatoes.']
            ],
            [
                'tr' => 'Salt & Vinegar Patates', 
                'en' => 'Salt & Vinegar Fries', 
                'price' => 290, 
                'desc' => ['tr' => 'Tuz ve sirke aromalı çıtır patates kızartması', 'en' => 'Crispy fries flavored with salt and vinegar']
            ],
            [
                'tr' => 'Chicken Fingers', 
                'en' => 'Chicken Fingers', 
                'price' => 700, 
                'desc' => ['tr' => 'Panelenmiş tavuk dilimleri, kajun baharatlı patates ile', 'en' => 'Breaded chicken fingers served with cajun seasoned fries']
            ],
            [
                'tr' => 'Buffalo Wings', 
                'en' => 'Buffalo Wings', 
                'price' => 1000, 
                'desc' => ['tr' => 'Acılı buffalo soslu kızarmış tavuk kanatları', 'en' => 'Fried chicken wings with spicy buffalo sauce']
            ],
            [
                'tr' => 'Misket Falafel', 
                'en' => 'Misket Falafel', 
                'price' => 750, 
                'desc' => ['tr' => 'Falafel topları (nohut), mevsim yeşillikleri ve tahin sos ile', 'en' => 'Falafel balls (chickpeas) served with seasonal greens and tahini sauce']
            ],
            [
                'tr' => 'Bira Tabağı', 
                'en' => 'Beer Platter', 
                'price' => 1100, 
                'desc' => ['tr' => 'Mozzarella stick, soğan halkası, sosis, cips ve tavuk dilimleri', 'en' => 'Mozzarella sticks, onion rings, sausage, chips and chicken strips']
            ],
            [
                'tr' => 'Kalamar Tava', 
                'en' => 'Fried Calamari', 
                'price' => 760, 
                'desc' => ['tr' => 'Çıtır kalamar, mevsim yeşillikleri ve tarator sos ile', 'en' => 'Crispy calamari served with seasonal greens and tarator sauce']
            ],
            [
                'tr' => 'Tereyağlı Sarımsaklı Karides', 
                'en' => 'Butter & Garlic Shrimp', 
                'price' => 760, 
                'desc' => ['tr' => 'Tereyağı, sarımsak, karides, kuru domates', 'en' => 'Shrimp with butter, garlic and sun-dried tomatoes']
            ],
            [
                'tr' => 'Kaşarlı Mantar', 
                'en' => 'Mushrooms with Cheese', 
                'price' => 360, 
                'desc' => ['tr' => 'Mantar, kaşar, sarımsak, tereyağ', 'en' => 'Mushrooms with kashar cheese, garlic and butter']
            ],
            [
                'tr' => 'Izgara Hellim', 
                'en' => 'Grilled Halloumi', 
                'price' => 400, 
                'desc' => ['tr' => 'Hellim peyniri ve mevsim yeşillikleri', 'en' => 'Grilled halloumi cheese served with seasonal greens']
            ],
            [
                'tr' => 'Tavuk Nachos', 
                'en' => 'Chicken Nachos', 
                'price' => 450, 
                'desc' => ['tr' => 'Tavuk, Mısır tortilla, cheddar peyniri, renkli biber, mısır ve soslar', 'en' => 'Chicken, corn tortilla, cheddar cheese, bell peppers, corn and sauces']
            ],
            [
                'tr' => 'Et Nachos', 
                'en' => 'Beef Nachos', 
                'price' => 650, 
                'desc' => ['tr' => 'Jülyen bonfile, Mısır tortilla, cheddar peyniri, renkli biber, mısır ve soslar', 'en' => 'Beef tenderloin, corn tortilla, cheddar cheese, bell peppers, corn and sauces']
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
                'en' => 'Arugula Salad', 
                'price' => 500, 
                'desc' => ['tr' => 'Roka, cherry domates, parmesan, kuru domates, ceviz, sarımsaklı sos', 'en' => 'Arugula, cherry tomatoes, parmesan, sun-dried tomatoes, walnuts with garlic dressing']
            ],
            [
                'tr' => 'Çoban Salatası', 
                'en' => 'Shepherd Salad', 
                'price' => 480, 
                'desc' => ['tr' => 'Domates, salatalık, soğan, biber ve maydanoz', 'en' => 'Tomatoes, cucumbers, onions, peppers and parsley']
            ],
            [
                'tr' => 'Ton Balıklı Salata', 
                'en' => 'Tuna Salad', 
                'price' => 600, 
                'desc' => ['tr' => 'Ton balığı, haşlanmış yumurta, mısır ve yeşillikler', 'en' => 'Tuna fish, boiled egg, corn and mixed greens']
            ],
            [
                'tr' => 'Sezar Salata', 
                'en' => 'Caesar Salad', 
                'price' => 550, 
                'desc' => ['tr' => 'Izgara tavuk, kruton, parmesan ve sezar sos', 'en' => 'Grilled chicken, croutons, parmesan cheese and caesar dressing']
            ],
            [
                'tr' => 'Dana Bonfile Salata', 
                'en' => 'Beef Tenderloin Salad', 
                'price' => 720, 
                'desc' => ['tr' => 'Izgara bonfile dilimleri, yeşillik ve narenciye sos', 'en' => 'Grilled beef tenderloin slices with mixed greens and citrus dressing']
            ],
        ]);

        // 3. DÜRÜMLER (Wraps)
        $wraps = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Wraps', 'tr' => 'Dürümler'],
            'order_column' => 3,
            'is_active' => true
        ]);
        $this->seedItems($wraps->id, [
            [
                'tr' => 'Et Dürüm', 
                'en' => 'Beef Wrap', 
                'price' => 700, 
                'desc' => ['tr' => 'Jülyen bonfile, biber, soğan ve mozzarella ile', 'en' => 'Beef tenderloin julienne, peppers, onions and mozzarella']
            ],
            [
                'tr' => 'Tavuk Dürüm', 
                'en' => 'Chicken Wrap', 
                'price' => 600, 
                'desc' => ['tr' => 'Jülyen tavuk, biber, soğan ve mozzarella ile', 'en' => 'Chicken julienne, peppers, onions and mozzarella']
            ],
        ]);

        // 4. FAJİTALAR (Fajitas)
        $fajitas = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Fajitas', 'tr' => 'Fajitalar'],
            'order_column' => 4,
            'is_active' => true
        ]);
        $this->seedItems($fajitas->id, [
            [
                'tr' => 'Et Fajita', 
                'en' => 'Beef Fajita', 
                'price' => 1250, 
                'desc' => ['tr' => 'Bonfile dilimleri, renkli biberler ve soğan ile servis edilir', 'en' => 'Served with beef tenderloin slices, colorful peppers and onions']
            ],
            [
                'tr' => 'Tavuk Fajita', 
                'en' => 'Chicken Fajita', 
                'price' => 1100, 
                'desc' => ['tr' => 'Tavuk dilimleri, renkli biberler ve soğan ile servis edilir', 'en' => 'Served with chicken slices, colorful peppers and onions']
            ],
            [
                'tr' => 'Combo Fajita', 
                'en' => 'Combo Fajita', 
                'price' => 1300, 
                'desc' => ['tr' => 'Bonfile ve tavuk birlikte, biber ve soğan ile', 'en' => 'Both beef and chicken served with peppers and onions']
            ],
            [
                'tr' => 'Vejetaryen Fajita', 
                'en' => 'Vegetarian Fajita', 
                'price' => 950, 
                'desc' => ['tr' => 'Renkli biberler ve sebzeler ile servis edilir', 'en' => 'Served with colorful peppers and vegetables']
            ],
        ]);

        // 5. MAKARNALAR (Pastas)
        $pastas = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Pastas', 'tr' => 'Makarnalar'],
            'order_column' => 5,
            'is_active' => true
        ]);
        $this->seedItems($pastas->id, [
            [
                'tr' => 'Biftekli Penne', 
                'en' => 'Beef Penne', 
                'price' => 0, 
                'desc' => ['tr' => 'Bonfile parçaları, mantar, kuru domates ve pesto sos', 'en' => 'Beef pieces, mushrooms, sun-dried tomatoes and pesto sauce']
            ],
            [
                'tr' => 'Arrabbiata', 
                'en' => 'Arrabbiata', 
                'price' => 0, 
                'desc' => ['tr' => 'Acılı domates sos ve siyah zeytin ile', 'en' => 'Spicy tomato sauce and black olives']
            ],
            [
                'tr' => 'Ragu Spaghetti', 
                'en' => 'Ragu Spaghetti', 
                'price' => 0, 
                'desc' => ['tr' => 'Bolognese sos ve parmesan peyniri ile', 'en' => 'Bolognese sauce and parmesan cheese']
            ],
            [
                'tr' => 'Deniz Ürünlü Tagliatelle', 
                'en' => 'Seafood Tagliatelle', 
                'price' => 0, 
                'desc' => ['tr' => 'Karides, kalamar ve midye ile krema sos', 'en' => 'Cream sauce with shrimp, calamari and mussels']
            ],
            [
                'tr' => 'Fettuccine Alfredo', 
                'en' => 'Fettuccine Alfredo', 
                'price' => 0, 
                'desc' => ['tr' => 'Tavuk, mantar ve krema sos ile', 'en' => 'Chicken, mushroom and cream sauce']
            ],
        ]);

        // 6. BURGERLER (Burgers)
        $burgers = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Burgers', 'tr' => 'Burgerler'],
            'order_column' => 6,
            'is_active' => true
        ]);
        $this->seedItems($burgers->id, [
            [
                'tr' => 'Beef Burger', 
                'en' => 'Beef Burger', 
                'price' => 750, 
                'desc' => ['tr' => '180g dana burger, marul, domates ve turşu', 'en' => '180g beef patty, lettuce, tomato and pickles']
            ],
            [
                'tr' => 'Cheese Burger', 
                'en' => 'Cheese Burger', 
                'price' => 800, 
                'desc' => ['tr' => '180g dana burger ve cheddar peyniri', 'en' => '180g beef patty and cheddar cheese']
            ],
            [
                'tr' => 'Mexica Burger', 
                'en' => 'Mexican Burger', 
                'price' => 820, 
                'desc' => ['tr' => 'Dana burger, mısır, biber ve cheddar ile', 'en' => 'Beef patty with corn, peppers and cheddar cheese']
            ],
            [
                'tr' => 'Chicken Burger', 
                'en' => 'Chicken Burger', 
                'price' => 650, 
                'desc' => ['tr' => 'Çıtır tavuk, domates ve cheddar ile', 'en' => 'Crispy chicken, tomato and cheddar cheese']
            ],
        ]);

        // 7. ANA YEMEKLER (Main Courses)
        $mainCourses = Category::create([
            'parent_id' => $lunchCat->id,
            'name' => ['en' => 'Main Courses', 'tr' => 'Ana Yemekler'],
            'order_column' => 7,
            'is_active' => true
        ]);
        $this->seedItems($mainCourses->id, [
            [
                'tr' => 'Izgara Köfte', 
                'en' => 'Grilled Meatballs', 
                'price' => 1000, 
                'desc' => ['tr' => 'Dana kıyma ve soğan. Köz biber, köz domates, pilav ve patates cips ile servis edilir', 'en' => 'Beef mince and onions. Served with grilled peppers, grilled tomatoes, rice and potato chips']
            ],
            [
                'tr' => 'Kuzu Şiş', 
                'en' => 'Lamb Shish', 
                'price' => 1350, 
                'desc' => ['tr' => 'Marine edilmiş kuzu eti. Köz biber, köz domates, pilav ve patates cips ile servis edilir', 'en' => 'Marinated lamb meat. Served with grilled peppers, grilled tomatoes, rice and potato chips']
            ],
            [
                'tr' => 'Tavuk Şinitzel', 
                'en' => 'Chicken Schnitzel', 
                'price' => 900, 
                'desc' => ['tr' => 'Pane kaplı tavuk göğsü, patates cips ile servis edilir', 'en' => 'Breaded chicken breast, served with potato chips']
            ],
            [
                'tr' => 'Tavuk Şiş', 
                'en' => 'Chicken Shish', 
                'price' => 800, 
                'desc' => ['tr' => 'Tavuk bonfile dilimleri. Köz biber, köz domates, pilav ve patates cips ile servis edilir', 'en' => 'Chicken fillet cubes. Served with grilled peppers, grilled tomatoes, rice and potato chips']
            ],
            [
                'tr' => 'Tatlı Ekşi Tavuk', 
                'en' => 'Sweet & Sour Chicken', 
                'price' => 990, 
                'desc' => ['tr' => 'Julienne tavuk dilimleri, renkli biberler ve soğan ile hazırlanır. Pilav ve patates cips ile servis edilir', 'en' => 'Julienne chicken strips prepared with colorful peppers and onions. Served with rice and potato chips']
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
                'desc' => ['tr' => 'Antep fıstıklı', 'en' => 'With pistachios']
            ],
            [
                'tr' => 'İrmik Helvası', 
                'en' => 'Semolina Halva', 
                'price' => 350, 
                'desc' => ['tr' => 'Tereyağlı', 'en' => 'With butter']
            ],
            [
                'tr' => 'Meyve Tabağı', 
                'en' => 'Fruit Platter', 
                'price' => 300, 
                'desc' => ['tr' => 'Mevsim meyveleri', 'en' => 'Seasonal fruits']
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
                'is_active' => true,
                'order_column' => $i + 1,
            ]);
        }
    }
}
