<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Support\Str;

class DinnerMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Find existing "Akşam Yemeği Menüsü"
        $dinnerCat = Category::where('name->tr', 'Akşam Yemeği Menüsü')
            ->orWhere('name->en', 'Dinner Menu')
            ->first();

        if (!$dinnerCat) {
            $dinnerCat = Category::create([
                'name' => ['en' => 'Dinner Menu', 'tr' => 'Akşam Yemeği Menüsü'],
                'slug' => ['en' => 'dinner-menu', 'tr' => 'aksam-yemegi-menusu'],
                'description' => ['en' => 'An exquisite selection for your evening.', 'tr' => 'Akşamınız için seçkin bir lezzet yelpazesi.'],
                'is_active' => true,
                'order_column' => 2,
            ]);
        }

        // Clean up categories under 20 to start fresh
        $oldSubCats = Category::where('parent_id', $dinnerCat->id)->get();
        foreach ($oldSubCats as $cat) {
            $cat->delete();
        }

        // 1. SOĞUK MEZELER (Cold Appetizers)
        $coldMezze = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Cold Appetizers', 'tr' => 'Soğuk Mezeler'],
            'order_column' => 1,
            'is_active' => true
        ]);
        $this->seedItems($coldMezze->id, [
            [
                'tr' => 'Fava', 
                'en' => 'Broad Bean Dip', 
                'price' => 300, 
                'desc' => ['tr' => 'Zeytinyağlı bakla ezmesi, soğan ve dereotu ile hazırlanır.', 'en' => 'Broad bean paste is prepared with olive oil, onions and dill.']
            ],
            [
                'tr' => 'Börülce', 
                'en' => 'Black-Eyed Peas', 
                'price' => 290, 
                'desc' => ['tr' => 'Zeytinyağı, limon ve sarımsak ile marine edilir.', 'en' => 'It is marinated with olive oil, lemon, and garlic.']
            ],
            [
                'tr' => 'Pancar', 
                'en' => 'Beetroot Dip', 
                'price' => 290, 
                'desc' => ['tr' => 'Yoğurt, pancar ve sarımsak ile hazırlanır.', 'en' => 'Prepared with yogurt, beetroot and garlic.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Şakşuka', 
                'en' => 'Shakshuka', 
                'price' => 300, 
                'desc' => ['tr' => 'Kızarmış patlıcan, kırmızı ve yeşil biber, domates ve sarımsak ile hazırlanır.', 'en' => 'Prepared with fried aubergine, red and green peppers, tomato and garlic.']
            ],
            [
                'tr' => 'Köpoğlu', 
                'en' => 'Eggplant with Yogurt and Tomato', 
                'price' => 340, 
                'desc' => ['tr' => 'Kızarmış patlıcan, yoğurt, patates ve domates sos ile hazırlanır.', 'en' => 'Prepared with fried aubergine, yogurt, potatoes and tomato sauce.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Kuru Cacık', 
                'en' => 'Thick Tzatziki', 
                'price' => 290, 
                'desc' => ['tr' => 'Yoğurt, salatalık, zeytinyağı, sarımsak ve nane ile hazırlanır.', 'en' => 'Prepared with yogurt, cucumber, olive oil, garlic and mint.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => '5’li Ordövr Tabağı', 
                'en' => '5-Piece Appetizer Plate', 
                'price' => 1300, 
                'desc' => ['tr' => 'Şefin seçtiği 5 çeşit meze.', 'en' => "Chef's selection of 5 different mezes."], 
                'allergens' => ['tr' => 'Gluten, Deniz Ürünleri, Süt', 'en' => 'Gluten, Seafood, Milk']
            ],
            [
                'tr' => 'Havuç Tarator', 
                'en' => 'Carrot Tarator', 
                'price' => 340, 
                'desc' => ['tr' => 'Yoğurt, havuç, ceviz, ve sarımsak ile hazırlanır.', 'en' => 'Prepared with yogurt, carrot, walnut and garlic.'], 
                'allergens' => ['tr' => 'Süt, Kuruyemiş', 'en' => 'Milk, Nuts']
            ],
            [
                'tr' => 'Atom', 
                'en' => 'Spicy Fried Chili', 
                'price' => 340, 
                'desc' => ['tr' => 'Yoğurt ve acı biber ile hazırlanır.', 'en' => 'Prepared with yogurt and hot pepper.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Acılı Ezme', 
                'en' => 'Spicy Ezme', 
                'price' => 340, 
                'desc' => ['tr' => 'Domates, biber, salatalık, maydanoz, soğan, nar ekşisi ve baharat ile hazırlanır.', 'en' => 'Prepared with tomato, onion, pomegranate molasses, peppercucumber, parsley and spices.']
            ],
            [
                'tr' => 'Humus', 
                'en' => 'Hummus', 
                'price' => 300, 
                'desc' => ['tr' => 'Nohut, tahin, kimyon, süt, yoğurt, sumak, limon ve baharat ile hazırlanır.', 'en' => 'Prepared with chickpeas, milk, yogurt, tahini, olive oil, cumin, sumac, lemon and spices.'], 
                'allergens' => ['tr' => 'Susam', 'en' => 'Sesame']
            ],
            [
                'tr' => 'Kara Koruğu', 
                'en' => 'Rock Samphire', 
                'price' => 350, 
                'desc' => ['tr' => 'Kaya koruğu, zeytinyağı ve limon ile hazırlanır.', 'en' => 'Prepared with samphire, olive oil and lemon.']
            ],
            [
                'tr' => 'Peynir & Kavun', 
                'en' => 'Cheese & Melon', 
                'price' => 400, 
                'desc' => ['tr' => 'Beyaz peynir ve kavun dilimleri ile servis edilir.', 'en' => 'Served with white cheese and sliced melon.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
        ]);

        // 2. SALATALAR (Salads)
        $salads = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Salads', 'tr' => 'Salatalar'],
            'order_column' => 2,
            'is_active' => true
        ]);
        $this->seedItems($salads->id, [
            [
                'tr' => 'Roka Salatası', 
                'en' => 'Rocket Salad', 
                'price' => 500, 
                'desc' => ['tr' => 'Roka, ezine peyniri, cherry domates, ceviz ve sarımsaklı ve yeşil elmalı sos ile hazırlanır.', 'en' => 'Prepared with rocket, cherry tomatoes, ezine cheese, walnut, green apple and garlic dressing.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Greek Salata', 
                'en' => 'Greek Salad', 
                'price' => 500, 
                'desc' => ['tr' => 'Mor soğan, salatalık, zeytin, biber, kroton ve peynir ile.', 'en' => 'Prepared with red onion, cucumber, olives, peppers, croutons and cheese.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Gavurdağı Salatası', 
                'en' => 'Gavurdağı Salad', 
                'price' => 500, 
                'desc' => ['tr' => 'Domates, ceviz, nar ekşisi, salatalık, biber, maydanoz ve soğan ile hazırlanır.', 'en' => 'Prepared with tomato, walnut, pomegranate molasses, cucumber, pepper, parsley and onion.'], 
                'allergens' => ['tr' => 'Kuruyemiş', 'en' => 'Nuts']
            ],
            [
                'tr' => 'Kaşık Salata', 
                'en' => 'Chopped Salad', 
                'price' => 480, 
                'desc' => ['tr' => 'Domates, salatalık, biber, maydanoz, soğan ve zeytinyağı ile hazırlanır.', 'en' => 'Prepared with tomato, cucumber, pepper, onion, parsley and olive oil.']
            ],
            [
                'tr' => 'Dana Bonfile Salata', 
                'en' => 'Beef Tenderloin Salad', 
                'price' => 720, 
                'desc' => ['tr' => 'Izgara bonfile ve mevsim yeşillikleri ile hazırlanır.', 'en' => 'Prepared with grilled beef tenderloin and seasonal greens.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
        ]);

        // 3. ARA SICAKLAR (Hot Starters)
        $hotAppetizers = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Hot Starters', 'tr' => 'Ara Sıcaklar'],
            'order_column' => 3,
            'is_active' => true
        ]);
        $this->seedItems($hotAppetizers->id, [
            [
                'tr' => 'Kaşarlı Mantar', 
                'en' => 'Mushrooms with Kashar Cheese', 
                'price' => 360, 
                'desc' => ['tr' => 'Mantar, kaşar peyniri, sarımsak ve tereyağı ile hazırlanır.', 'en' => 'Prepared with mushrooms, kashar cheese, garlic and butter.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Hellim Izgara', 
                'en' => 'Grilled Halloumi', 
                'price' => 400, 
                'desc' => ['tr' => 'Hellim peyniri, köz biber, cherry domates ile servis edilir.', 'en' => 'Served with halloumi cheese, cherry tomatoes and roasted pepper'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Mücver', 
                'en' => 'Courgette Fritters', 
                'price' => 320, 
                'desc' => ['tr' => 'Kabak, havuç, yeşil soğan, maydonoz, dere otu, nane, beyaz peynir, un ve yumurta ile hazırlanır.', 'en' => 'Prepared with courgette, carrot, green onions, parsley, dill, mint, white cheese, flour, and eggs.'], 
                'allergens' => ['tr' => 'Yumurta, Gluten, Süt', 'en' => 'Egg, Gluten, Milk']
            ],
            [
                'tr' => 'Kalamar Tava', 
                'en' => 'Fried Calamari', 
                'price' => 760, 
                'desc' => ['tr' => 'Kalamar, yeşillik ve tarator sos ile servis edilir.', 'en' => 'Served with calamari, greens and tarator sauce.'], 
                'allergens' => ['tr' => 'Deniz Ürünleri, Gluten, Süt', 'en' => 'Seafood, Gluten, Milk']
            ],
            [
                'tr' => 'Midye Tava', 
                'en' => 'Fried Mussels', 
                'price' => 650, 
                'desc' => ['tr' => 'Çıtır midye ve patates cipsi ile servis edilir.', 'en' => 'Served with crispy mussels and potato chips.'], 
                'allergens' => ['tr' => 'Deniz Ürünleri, Gluten', 'en' => 'Seafood, Gluten']
            ],
            [
                'tr' => 'Yaprak Ciğer', 
                'en' => 'Lamb Liver', 
                'price' => 720, 
                'desc' => ['tr' => 'Kızartılmış kuzu ciğer ve kuru soğan ile servis edilir.', 'en' => 'Served with fried lamb liver and dry onions.'], 
                'allergens' => ['tr' => 'Gluten', 'en' => 'Gluten']
            ],
            [
                'tr' => 'Karidesli Börek', 
                'en' => 'Shrimp Pastry', 
                'price' => 690, 
                'desc' => ['tr' => 'Karides ve mevsim sebzeleri ile servis edilir.', 'en' => 'Prepared with shrimp and seasonal vegetables.'], 
                'allergens' => ['tr' => 'Deniz Ürünleri, Gluten', 'en' => 'Seafood, Gluten']
            ],
            [
                'tr' => 'Tereyağlı Sarımsaklı Karides', 
                'en' => 'Butter Garlic Shrimp', 
                'price' => 760, 
                'desc' => ['tr' => 'Karides, tereyağı, sarımsak ve limon ile servis edilir.', 'en' => 'Prepared with shrimp, butter, garlic and lemon.'], 
                'allergens' => ['tr' => 'Deniz Ürünleri, Süt', 'en' => 'Seafood, Milk']
            ],
            [
                'tr' => 'Deniz Ürünleri Combo', 
                'en' => 'Seafood Combo', 
                'price' => 1450, 
                'desc' => ['tr' => 'Kalamar, karides ve midye tabağı.', 'en' => 'Calamari, shrimp and mussels plate.'], 
                'allergens' => ['tr' => 'Deniz Ürünleri, Gluten, Süt', 'en' => 'Seafood, Gluten, Milk']
            ],
        ]);

        // 4. GARNİTÜRLER / SIDE DISHES
        $sideDishes = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Side Dishes', 'tr' => 'Garnitürler'],
            'order_column' => 4,
            'is_active' => true
        ]);
        $this->seedItems($sideDishes->id, [
            [
                'tr' => 'Cips', 
                'en' => 'French Fries', 
                'price' => 200, 
                'desc' => ['tr' => 'Kızarmış patates.', 'en' => 'French fries.']
            ],
            [
                'tr' => 'Yoğurt', 
                'en' => 'Yogurt', 
                'price' => 100, 
                'desc' => ['tr' => 'Süzme yoğurt.', 'en' => 'Strained yogurt.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Pilav', 
                'en' => 'Rice', 
                'price' => 150, 
                'desc' => ['tr' => 'Tereyağlı pirinç pilavı.', 'en' => 'Rice with butter.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
        ]);

        // 5. ANA YEMEKLER (Main Courses)
        $mainCourses = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Main Courses', 'tr' => 'Ana Yemekler'],
            'order_column' => 5,
            'is_active' => true
        ]);
        // BALIK / FISH
        $this->seedItems($mainCourses->id, [
            [
                'tr' => 'Izgara Levrek', 
                'en' => 'Grilled Sea Bass', 
                'price' => 1050, 
                'desc' => ['tr' => 'Levrek, limon, yeşil salata, baby patates ve balık sos ile servis edilir.', 'en' => 'Served with lemon, green salad, baby potatoes and fish sauce.'], 
                'allergens' => ['tr' => 'Balık', 'en' => 'Fish']
            ],
            [
                'tr' => 'Izgara Çipura', 
                'en' => 'Grilled Sea Bream', 
                'price' => 1050, 
                'desc' => ['tr' => 'Zeytinyağı , limon, yeşil salata, baby patates ve balık sos ile servis edilir.', 'en' => 'Served with lemon, green salad, baby potatoes and fish sauce.'], 
                'allergens' => ['tr' => 'Balık', 'en' => 'Fish']
            ],
            [
                'tr' => 'Güveçte Tereyağlı Alabalık', 
                'en' => 'Buttered Trout Casserole', 
                'price' => 1500, 
                'desc' => ['tr' => 'Tereyağı, alabalık, sarımsak ve mevsim sebzeleri ile hazırlanır.', 'en' => 'Prepared with butter, trout, garlic and seasonal vegetables.'], 
                'allergens' => ['tr' => 'Balık, Süt', 'en' => 'Fish, Milk']
            ],
            [
                'tr' => 'Günün Balığı', 
                'en' => 'Fish of the Day', 
                'price' => 0, 
                'desc' => ['tr' => 'Günlük taze balık.', 'en' => 'Fresh daily fish selection.'], 
                'allergens' => ['tr' => 'Balık', 'en' => 'Fish']
            ],
            // ET / MEAT
            [
                'tr' => 'Et Kavurma', 
                'en' => 'Sautéed Beef', 
                'price' => 1400, 
                'desc' => ['tr' => 'Dana eti, biber, domates sos ve soğan ile hazırlanır.', 'en' => 'Prepared with beef, tomato sauce and onion.']
            ],
            [
                'tr' => 'Kuzu Pirzola', 
                'en' => 'Lamb Chops', 
                'price' => 1750, 
                'desc' => ['tr' => 'Izgara kuzu pirzola, köz biber, domates, soğan, pilav ve baby patates.', 'en' => 'Grilled lamb chops, roasted peppers, tomatoes, onion, rice and baby potatoes.']
            ],
            [
                'tr' => 'Ev Yapımı Köfte', 
                'en' => 'Homemade Meatballs', 
                'price' => 1000, 
                'desc' => ['tr' => 'Kıyma ve soğan ile hazırlanır. Köz biber, domates, soğan, pilav ve baby patates.', 'en' => 'Prepared with minced meat and onion. Roasted peppers, tomatoes, onions, rice and baby potatoes.'], 
                'allergens' => ['tr' => 'Süt, Gluten', 'en' => 'Milk, Gluten']
            ],
            [
                'tr' => 'Kuzu Şiş', 
                'en' => 'Lamb Shish', 
                'price' => 1350, 
                'desc' => ['tr' => 'Marine edilmiş kuzu şiş. Köz biber, domates, soğan, pilav ve baby patates.', 'en' => 'Marinated lamb shish. Roasted peppers, tomatoes, onions, rice and baby potatoes.']
            ],
            [
                'tr' => 'Karışık Izgara', 
                'en' => 'Mixed Grill', 
                'price' => 2650, 
                'desc' => ['tr' => 'Farklı ızgara et çeşitlerinden oluşur. Köz biber, domates, soğan, pilav ve baby patates.', 'en' => 'A selection of mixed grilled meats. Roasted peppers, tomatoes, onions, rice and baby potatoes.']
            ],
            // TAVUK / CHICKEN
            [
                'tr' => 'Limonlu Tavuk', 
                'en' => 'Lemon Chicken', 
                'price' => 950, 
                'desc' => ['tr' => 'Izgara tavuk, limon sos ve patates cipsi ile servis edilir.', 'en' => 'Served with grilled chicken, lemon sauce and potato crisps.'], 
                'allergens' => ['tr' => 'Süt', 'en' => 'Milk']
            ],
            [
                'tr' => 'Tavuk Kanat', 
                'en' => 'Chicken Wings', 
                'price' => 990, 
                'desc' => ['tr' => 'Izgara tavuk kanatları, köz biber, domates, soğan, pilav ve baby patates.', 'en' => 'Grilled chicken wings, roasted peppers, tomatoes, onion, rice and baby potatoes.']
            ],
        ]);

        // 6. FAJİTALAR (Fajitas)
        $dinnerFajitas = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Fajitas', 'tr' => 'Fajitalar'],
            'order_column' => 6,
            'is_active' => true
        ]);
        $this->seedItems($dinnerFajitas->id, [
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

        // 7. ÇOCUK MENÜSÜ (Kid's Menu)
        $kidsMenu = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => "Kid's Menu", 'tr' => 'Çocuk Menüsü'],
            'order_column' => 7,
            'is_active' => true
        ]);
        $this->seedItems($kidsMenu->id, [
            [
                'tr' => 'Balık Kroket & Patates', 
                'en' => 'Fish Nuggets & Chips', 
                'price' => 1100, 
                'desc' => ['tr' => 'Çıtır balık kroket ve patates kızartması.', 'en' => 'Crispy fish nuggets and french fries.'], 
                'allergens' => ['tr' => 'Balık, Gluten', 'en' => 'Fish, Gluten']
            ],
            [
                'tr' => 'Chicken Fingers', 
                'en' => 'Chicken Fingers', 
                'price' => 700, 
                'desc' => ['tr' => 'Tavuk dilimleri ve patates kızartması ile servis edilir.', 'en' => 'Chicken strips and french fries.'], 
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Köfte & Patates', 
                'en' => 'Meatballs & Chips', 
                'price' => 890, 
                'desc' => ['tr' => 'Izgara köfte ve patates kızartması ile servis edilir.', 'en' => 'Grilled meatballs and french fries.'], 
                'allergens' => ['tr' => 'Süt, Gluten', 'en' => 'Milk, Gluten']
            ],
            [
                'tr' => 'Burger & Chips', 
                'en' => 'Burger & Chips', 
                'price' => 750, 
                'desc' => ['tr' => 'Çocuk burger ve patates kızartması ile servis edilir.', 'en' => 'Kid’s burger and french fries.'], 
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
            [
                'tr' => 'Spagetti', 
                'en' => 'Spaghetti', 
                'price' => 690, 
                'desc' => ['tr' => 'Domates soslu veya tereyağlı.', 'en' => 'With tomato sauce or butter.'], 
                'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']
            ],
        ]);

        // 8. TATLILAR (Desserts)
        $desserts = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Desserts', 'tr' => 'Tatlılar'],
            'order_column' => 8,
            'is_active' => true
        ]);
        $this->seedItems($desserts->id, [
            [
                'tr' => 'Havuç Dilimi Baklava', 
                'en' => 'Carrot Slice Baklava', 
                'price' => 550, 
                'desc' => ['tr' => 'Baklava hamuru, antep fıstığı, şeker şurubu ve tereyağı ile paketlenir; dondurma ile servis edilir.', 'en' => 'Phyllo dough packed with pistachios, sugar syrup and butter; served with ice cream.'], 
                'allergens' => ['tr' => 'Kuruyemiş, Süt, Gluten', 'en' => 'Nuts, Milk, Gluten']
            ],
            [
                'tr' => 'İrmik Helvası', 
                'en' => 'Semolina Halva', 
                'price' => 300, 
                'desc' => ['tr' => 'İrmik, süt, şeker, margarin ve antep fıstığı; dondurma ile.', 'en' => 'Semolina, milk, sugar, margarine and pistachios; with ice cream.'], 
                'allergens' => ['tr' => 'Süt, Kuruyemiş', 'en' => 'Milk, Nuts']
            ],
            [
                'tr' => 'Meyve Tabağı', 
                'en' => 'Fruit Platter', 
                'price' => 350, 
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
