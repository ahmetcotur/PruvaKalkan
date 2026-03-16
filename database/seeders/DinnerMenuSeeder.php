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
            MenuItem::where('category_id', $cat->id)->delete();
            $cat->delete();
        }

        // 1. SOĞUK MEZELER (Cold Mezze)
        $coldMezze = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Cold Appetizers', 'tr' => 'Soğuk Mezeler'],
            'order_column' => 1,
            'is_active' => true
        ]);
        $this->seedItems($coldMezze->id, [
            ['tr' => 'Fava', 'en' => 'Fava', 'price' => 300, 'desc' => ['tr' => 'Zeytinyağlı, bakla, soğan, portakal, dere out', 'en' => 'Fava beans with olive oil, onion, orange and dill']],
            ['tr' => 'Börülce', 'en' => 'Kidney Beans', 'price' => 290, 'desc' => ['tr' => 'Zeytinyağı ve limon ile marine', 'en' => 'Marinated with olive oil and lemon']],
            ['tr' => 'Pancar', 'en' => 'Beetroot', 'price' => 290, 'desc' => ['tr' => 'Yoğurt, pancar, sarımsak', 'en' => 'Yogurt, beetroot, garlic'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => 'Şakşuka', 'en' => 'Shakshuka', 'price' => 300, 'desc' => ['tr' => 'Kızarmış patlıcan, kırmızı ve yeşil biber, domates, sarımsak', 'en' => 'Fried eggplant, red and green peppers, tomatoes, garlic']],
            ['tr' => 'Köpoğlu', 'en' => 'Köpoğlu', 'price' => 340, 'desc' => ['tr' => 'Kızarmış patlıcan, yoğurt ve domates sos', 'en' => 'Fried eggplant, yogurt and tomato sauce'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => 'Kuru Cacık', 'en' => 'Strained Cacık', 'price' => 290, 'desc' => ['tr' => 'Yoğurt, salatalık ve zeytinyağı, nane', 'en' => 'Yogurt, cucumber, olive oil and mint'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => 'Havuç Tarator', 'en' => 'Carrot Tarator', 'price' => 340, 'desc' => ['tr' => 'Yoğurt, havuç, ceviz, sarımsak, zeytinyağı', 'en' => 'Yogurt, carrots, walnuts, garlic, olive oil'], 'allergens' => ['tr' => 'Süt, Kuruyemiş', 'en' => 'Milk, Nuts']],
            ['tr' => 'Atom', 'en' => 'Atom', 'price' => 340, 'desc' => ['tr' => 'Yogurt, sarımsak, acı biber', 'en' => 'Yogurt, garlic, hot peppers'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => 'Acılı Ezme', 'en' => 'Spicy Paste', 'price' => 340, 'desc' => ['tr' => 'Domates, biber, salatalık, maydanoz ve baharat', 'en' => 'Tomato, pepper, cucumber, parsley and spices']],
            ['tr' => 'Humus', 'en' => 'Hummus', 'price' => 300, 'desc' => ['tr' => 'Nohut, tahin, zeytinyağı, kimyon, sumak, limon, baharat', 'en' => 'Chickpeas, tahini, olive oil, cumin, sumac, lemon, spices'], 'allergens' => ['tr' => 'Kuruyemiş (Susam)', 'en' => 'Nuts (Sesame)']],
            ['tr' => 'Kara Koruğu', 'en' => 'Sea Beans (Kaya Koruğu)', 'price' => 350, 'desc' => ['tr' => 'kaya koruk, zeytinyağı, limon', 'en' => 'Samphire, olive oil, lemon']],
            ['tr' => 'Peynir & Kavun', 'en' => 'Cheese & Melon', 'price' => 400, 'desc' => ['tr' => 'Beyaz peynir ve kavun dilimleri', 'en' => 'Feta cheese and melon slices'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => '5’li Ordövr Tabağı', 'en' => 'Appetizer Platter (Selection of 5)', 'price' => 1300, 'desc' => ['tr' => 'Şefin seçtiği 5 çeşit meze', 'en' => '5 types of appetizers selected by the chef'], 'allergens' => ['tr' => 'Süt, Kuruyemiş, Gluten', 'en' => 'Milk, Nuts, Gluten']],
        ]);

        // 2. ARA SICAKLAR (Hot Starters)
        $hotAppetizers = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Hot Appetizers', 'tr' => 'Ara Sıcaklar'],
            'order_column' => 2,
            'is_active' => true
        ]);
        $this->seedItems($hotAppetizers->id, [
            ['tr' => 'Kaşarlı Mantar', 'en' => 'Mushrooms with Kashar', 'price' => 360, 'desc' => ['tr' => 'Mantar, kaşar, sarımsak, tereyağ', 'en' => 'Mushrooms, kashar cheese, garlic, butter'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => 'Hellim Izgara', 'en' => 'Grilled Halloumi', 'price' => 400, 'desc' => ['tr' => 'Hellim peyniri ve mevsim yeşillikleri', 'en' => 'Halloumi cheese and seasonal greens'], 'allergens' => ['tr' => 'Süt ve süt ürünleri', 'en' => 'Milk and dairy products']],
            ['tr' => 'Mücver', 'en' => 'Vegetable Fritters (Mücver)', 'price' => 320, 'desc' => ['tr' => 'Kabak, havuç, mevsim yeşillikleri', 'en' => 'Zucchini, carrot, seasonal greens'], 'allergens' => ['tr' => 'Yumurta, Gluten, Süt', 'en' => 'Egg, Gluten, Milk']],
            ['tr' => 'Kalamar Tava', 'en' => 'Fried Calamari', 'price' => 760, 'desc' => ['tr' => 'Kalamar, yeşillik ve tarator sos', 'en' => 'Calamari, greens and tarator sauce'], 'allergens' => ['tr' => 'Deniz Ürünleri, Gluten, Süt', 'en' => 'Seafood, Gluten, Milk']],
            ['tr' => 'Midye Tava', 'en' => 'Fried Mussels', 'price' => 650, 'desc' => ['tr' => 'Çıtır midye ve patates cipsi', 'en' => 'Crispy mussels and potato chips'], 'allergens' => ['tr' => 'Deniz Ürünleri, Gluten', 'en' => 'Seafood, Gluten']],
            ['tr' => 'Karidesli Börek', 'en' => 'Shrimp Pastry', 'price' => 690, 'desc' => ['tr' => 'Karides, mevsim yeşillikleri', 'en' => 'Shrimp, seasonal greens'], 'allergens' => ['tr' => 'Deniz Ürünleri, Gluten', 'en' => 'Seafood, Gluten']],
            ['tr' => 'Tereyağlı Sarımsaklı Karides', 'en' => 'Shrimp in Garlic Butter', 'price' => 760, 'desc' => ['tr' => 'Karides, sarımsak, kuru domates.', 'en' => 'Shrimp, garlic, sun-dried tomatoes.'], 'allergens' => ['tr' => 'Deniz Ürünleri, Süt', 'en' => 'Seafood, Milk']],
            ['tr' => 'Yaprak Kuzu Ciğer', 'en' => 'Fried Lamb Liver', 'price' => 720, 'desc' => ['tr' => 'kızartılmış kuzu ciğer ve kuru soğan', 'en' => 'Fried lamb liver and dry onions'], 'allergens' => ['tr' => 'Gluten', 'en' => 'Gluten']],
            ['tr' => 'Deniz Ürünleri Combo', 'en' => 'Seafood Combo', 'price' => 1450, 'desc' => ['tr' => 'Kalamar, karides ve midye', 'en' => 'Calamari, shrimp and mussels'], 'allergens' => ['tr' => 'Deniz Ürünleri, Gluten, Süt', 'en' => 'Seafood, Gluten, Milk']],
        ]);

        // 3. GARNİTÜRLER (Sides)
        $sides = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Sides', 'tr' => 'Garnitürler'],
            'order_column' => 3,
            'is_active' => true
        ]);
        $this->seedItems($sides->id, [
            ['tr' => 'Baby Patates', 'en' => 'Baby Potatoes', 'price' => 260, 'desc' => ['tr' => 'Tereyağı, baharat ve patates', 'en' => 'Butter, spices and potatoes'], 'allergens' => ['tr' => 'Süt', 'en' => 'Milk']],
            ['tr' => 'Köylü Patates', 'en' => 'Village Style Fries', 'price' => 310, 'desc' => ['tr' => 'Kabuklu patates kızartması, maydonoz, limon, baharat', 'en' => 'Fries with skin, parsley, lemon, spices']],
            ['tr' => 'Pirinç Pilavı', 'en' => 'Rice Pilaf', 'price' => 300, 'desc' => ['tr' => 'Pirinç, tereyağ', 'en' => 'Rice, butter'], 'allergens' => ['tr' => 'Süt', 'en' => 'Milk']],
            ['tr' => 'Sebze Sote', 'en' => 'Sautéed Vegetables', 'price' => 360, 'desc' => ['tr' => 'Zeytinyağında mevsim sebzeleri (sorunuz)', 'en' => 'Seasonal vegetables in olive oil (please ask)']],
        ]);

        // 4. SALATALAR (Salads)
        $salads = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Salads', 'tr' => 'Salatalar'],
            'order_column' => 4,
            'is_active' => true
        ]);
        $this->seedItems($salads->id, [
            ['tr' => 'Roka Salatası', 'en' => 'Arugula Salad', 'price' => 500, 'desc' => ['tr' => 'Roka, cherry domates, parmesan, kuru domates, ceviz, sarımsaklı sos', 'en' => 'Arugula, cherry tomatoes, parmesan, sun-dried tomatoes, walnuts, garlic sauce'], 'allergens' => ['tr' => 'Süt, Tuz', 'en' => 'Milk, Salt']],
            ['tr' => 'Çoban Salatası', 'en' => 'Shepherd\'s Salad', 'price' => 480, 'desc' => ['tr' => 'Domates, salatalık, soğan, biber, maydanoz', 'en' => 'Tomatoes, cucumbers, onions, peppers, parsley']],
            ['tr' => 'Gavurdağı Salatası', 'en' => 'Gavurdağı Salad', 'price' => 500, 'desc' => ['tr' => 'Domates, ceviz, nar ekşisi, salatalık, biber, maydanoz, peynir', 'en' => 'Tomatoes, walnuts, pomegranate molasses, cucumbers, peppers, parsley, cheese'], 'allergens' => ['tr' => 'Kuruyemiş', 'en' => 'Nuts']],
            ['tr' => 'Kaşık Salata', 'en' => 'Spoon Salad', 'price' => 480, 'desc' => ['tr' => 'Domates, salatalık, biber, maydonoz, zeytinyağı', 'en' => 'Tomatoes, cucumbers, peppers, parsley, olive oil']],
            ['tr' => 'Dana Bonfile Salata', 'en' => 'Beef Tenderloin Salad', 'price' => 720, 'desc' => ['tr' => 'Izgara bonfile ve mevsim yeşillik', 'en' => 'Grilled beef tenderloin and seasonal greens'], 'allergens' => ['tr' => 'Süt, Tuz', 'en' => 'Milk, Salt']],
        ]);

        // 5. ANA YEMEKLER - BALIK (Main - Fish)
        $mainFish = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Main Courses - Fish', 'tr' => 'Ana Yemekler - Balık'],
            'order_column' => 5,
            'is_active' => true
        ]);
        $this->seedItems($mainFish->id, [
            ['tr' => 'Izgara Levrek', 'en' => 'Grilled Sea Bass', 'price' => 1050, 'desc' => ['tr' => 'Levrek, limon, roka, patates', 'en' => 'Sea bass, lemon, arugula, potatoes'], 'allergens' => ['tr' => 'Balık', 'en' => 'Fish']],
            ['tr' => 'Izgara Çipura', 'en' => 'Grilled Sea Bream', 'price' => 1050, 'desc' => ['tr' => 'Zeytinyağı ve limon ile', 'en' => 'With olive oil and lemon'], 'allergens' => ['tr' => 'Balık', 'en' => 'Fish']],
            ['tr' => 'Güveçte Tereyağlı Alabalık', 'en' => 'Trout in Butter Stew', 'price' => 1500, 'desc' => ['tr' => 'Tereyağı, alabalık, sarımsak, mevsim sebzeleri', 'en' => 'Butter, trout, garlic, seasonal vegetables'], 'allergens' => ['tr' => 'Balık, Süt', 'en' => 'Fish, Milk']],
            ['tr' => 'Günün Balığı', 'en' => 'Catch of the Day', 'price' => 0, 'desc' => ['tr' => 'Günlük taze balık (Fiyat sorunuz)', 'en' => 'Daily fresh fish (Ask for price)'], 'allergens' => ['tr' => 'Balık', 'en' => 'Fish']],
        ]);

        // 6. ANA YEMEKLER - ET (Main - Meat)
        $mainMeat = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Main Courses - Meat', 'tr' => 'Ana Yemekler - Et'],
            'order_column' => 6,
            'is_active' => true
        ]);
        $this->seedItems($mainMeat->id, [
            ['tr' => 'Et Kavurma', 'en' => 'Beef Saute', 'price' => 1400, 'desc' => ['tr' => 'Dana eti, biber ve soğan', 'en' => 'Beef, peppers and onions']],
            ['tr' => 'Kuzu Pirzola', 'en' => 'Lamb Chops', 'price' => 1750, 'desc' => ['tr' => 'Izgara pirzola', 'en' => 'Grilled chops']],
            ['tr' => 'Home Made Köfte', 'en' => 'Homemade Meatballs', 'price' => 1000, 'desc' => ['tr' => 'Kıyma, soğan', 'en' => 'Minced meat, onion'], 'allergens' => ['tr' => 'Yumurta, Gluten', 'en' => 'Egg, Gluten']],
            ['tr' => 'Kuzu Şiş', 'en' => 'Lamb Shish', 'price' => 1350, 'desc' => ['tr' => 'Marine kuzu şiş', 'en' => 'Marinated lamb cubes']],
            ['tr' => 'Karışık Izgara', 'en' => 'Mixed Grill', 'price' => 2650, 'desc' => ['tr' => 'Farklı ızgara et çeşitleri', 'en' => 'Selection of grilled meats']],
        ]);

        // 7. ANA YEMEKLER - TAVUK (Main - Chicken)
        $mainChicken = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Main Courses - Chicken', 'tr' => 'Ana Yemekler - Tavuk'],
            'order_column' => 7,
            'is_active' => true
        ]);
        $this->seedItems($mainChicken->id, [
            ['tr' => 'Limonlu Tavuk', 'en' => 'Lemon Chicken', 'price' => 950, 'desc' => ['tr' => 'Izgara tavuk ve limon sos, patates cipsi', 'en' => 'Grilled chicken with lemon sauce and potato chips']],
            ['tr' => 'Tavuk Kanat', 'en' => 'Chicken Wings', 'price' => 990, 'desc' => ['tr' => 'Izgara veya kızarmış', 'en' => 'Grilled or fried']],
        ]);

        // 8. FAJITALAR (Fajitas)
        $dinnerFajitas = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Fajitas', 'tr' => 'Fajitalar'],
            'order_column' => 8,
            'is_active' => true
        ]);
        $this->seedItems($dinnerFajitas->id, [
            ['tr' => 'Et Fajita', 'en' => 'Beef Fajita', 'price' => 1250, 'desc' => ['tr' => 'Dana eti ve tortilla, renkli biberler, soğan', 'en' => 'Beef and tortilla, colorful peppers, onions'], 'allergens' => ['tr' => 'Gluten', 'en' => 'Gluten']],
            ['tr' => 'Tavuk Fajita', 'en' => 'Chicken Fajita', 'price' => 1100, 'desc' => ['tr' => 'Tavuk ve tortilla, renkli biberler ve soğan', 'en' => 'Chicken and tortilla, colorful peppers and onions'], 'allergens' => ['tr' => 'Gluten', 'en' => 'Gluten']],
            ['tr' => 'Vejetaryen Fajita', 'en' => 'Vegetarian Fajita', 'price' => 950, 'desc' => ['tr' => 'Meysim Sebzeli, tortilla', 'en' => 'Seasonal vegetables, tortilla'], 'allergens' => ['tr' => 'Gluten', 'en' => 'Gluten']],
        ]);

        // 9. ÇOCUK MENÜSÜ (Kids Menu)
        $kidsMenu = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Kids Menu', 'tr' => 'Çocuk Menüsü'],
            'order_column' => 9,
            'is_active' => true
        ]);
        $this->seedItems($kidsMenu->id, [
            ['tr' => 'Balık Kroket & Patates', 'en' => 'Fish Nuggets & Chips', 'price' => 1000, 'desc' => ['tr' => 'Balık kroket ve patates', 'en' => 'Fish nuggets and potatoes'], 'allergens' => ['tr' => 'Balık, Gluten', 'en' => 'Fish, Gluten']],
            ['tr' => 'Chicken Fingers', 'en' => 'Chicken Fingers', 'price' => 700, 'desc' => ['tr' => 'Tavuk ve patates', 'en' => 'Chicken and potatoes'], 'allergens' => ['tr' => 'Yumurta, Gluten', 'en' => 'Egg, Gluten']],
            ['tr' => 'Köfte & Patates', 'en' => 'Meatballs & Chips', 'price' => 890, 'desc' => ['tr' => 'Izgara köfte, patates', 'en' => 'Grilled meatballs and potatoes']],
            ['tr' => 'Burger & Cips', 'en' => 'Burger & Chips', 'price' => 750, 'desc' => ['tr' => 'Kıyma, marul, domates, turşu ve patates cips', 'en' => 'Minced meat, lettuce, tomato, pickles and potato chips']],
            ['tr' => 'Spagetti', 'en' => 'Spaghetti', 'price' => 690, 'desc' => ['tr' => 'Domates soslu veya tereyağlı', 'en' => 'With tomato sauce or butter'], 'allergens' => ['tr' => 'Gluten, Süt', 'en' => 'Gluten, Milk']],
        ]);

        // 10. TATLILAR (Desserts)
        $desserts = Category::create([
            'parent_id' => $dinnerCat->id,
            'name' => ['en' => 'Desserts', 'tr' => 'Tatlılar'],
            'order_column' => 10,
            'is_active' => true
        ]);
        $this->seedItems($desserts->id, [
            ['tr' => 'Havuç Dilimi Baklava', 'en' => 'Baklava (Carrot Slice)', 'price' => 500, 'desc' => ['tr' => 'Antep fıstıklı', 'en' => 'With pistachios'], 'allergens' => ['tr' => 'Kuruyemiş, Süt', 'en' => 'Nuts, Milk']],
            ['tr' => 'İrmik Helvası', 'en' => 'Semolina Halva', 'price' => 350, 'desc' => ['tr' => 'Tereyağlı', 'en' => 'With butter'], 'allergens' => ['tr' => 'Süt, Kuruyemiş', 'en' => 'Milk, Nuts']],
            ['tr' => 'Meyve Tabağı', 'en' => 'Fruit Platter', 'price' => 300, 'desc' => ['tr' => 'Mevsim meyveleri', 'en' => 'Seasonal fruits']],
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
