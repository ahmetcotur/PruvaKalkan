<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Branding
            [
                'key' => 'site_name',
                'value' => ['tr' => 'Pruva Restaurant', 'en' => 'Pruva Restaurant'],
                'type' => 'text',
                'group' => 'branding',
            ],
            [
                'key' => 'logo',
                'value' => ['tr' => 'logo.png', 'en' => 'logo.png'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'brand_olive',
                'value' => ['tr' => '#5c6448', 'en' => '#5c6448'],
                'type' => 'color',
                'group' => 'branding',
            ],
            [
                'key' => 'brand_light',
                'value' => ['tr' => '#f5f1e6', 'en' => '#f5f1e6'],
                'type' => 'color',
                'group' => 'branding',
            ],
            [
                'key' => 'brand_dark',
                'value' => ['tr' => '#2c2e27', 'en' => '#2c2e27'],
                'type' => 'color',
                'group' => 'branding',
            ],

            // Contact
            [
                'key' => 'phone',
                'value' => ['tr' => '+90 505 987 89 00', 'en' => '+90 505 987 89 00'],
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'whatsapp',
                'value' => ['tr' => '905059878900', 'en' => '905059878900'],
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'address',
                'value' => [
                    'tr' => 'Andifli, Hastane Cd. No:11, 07580 Kaş/Antalya',
                    'en' => 'Andifli, Hastane Cd. No:11, 07580 Kaş/Antalya'
                ],
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'google_maps_link',
                'value' => ['tr' => 'https://maps.app.goo.gl/xxx', 'en' => 'https://maps.app.goo.gl/xxx'],
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'email',
                'value' => ['tr' => 'info@pruvakalkan.com', 'en' => 'info@pruvakalkan.com'],
                'type' => 'text',
                'group' => 'contact',
            ],

            // SEO
            [
                'key' => 'meta_title',
                'value' => [
                    'tr' => 'Pruva Restaurant | Kaş Antalya',
                    'en' => 'Pruva Restaurant | Kaş Antalya'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'meta_description',
                'value' => [
                    'tr' => 'Kaş\'ın eşsiz manzarasında unutulmaz bir lezzet deneyimi.',
                    'en' => 'Unforgettable taste experience in the unique view of Kaş.'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'our_story_meta_title',
                'value' => [
                    'tr' => 'Hikayemiz | Pruva Restaurant Kaş',
                    'en' => 'Our Story | Pruva Restaurant Kaş'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'our_story_meta_description',
                'value' => [
                    'tr' => 'Pruva Restaurant\'ın kuruluş hikayesi ve Akdeniz lezzet yolculuğu.',
                    'en' => 'The founding story of Pruva Restaurant and its Mediterranean flavor journey.'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'gallery_meta_title',
                'value' => [
                    'tr' => 'Galeri | Pruva Restaurant Kaş',
                    'en' => 'Gallery | Pruva Restaurant Kaş'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'gallery_meta_description',
                'value' => [
                    'tr' => 'Pruva Restaurant\'tan kareler, lezzetler ve manzara.',
                    'en' => 'Snapshots, flavors, and views from Pruva Restaurant.'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'contact_meta_title',
                'value' => [
                    'tr' => 'İletişim | Pruva Restaurant Kaş',
                    'en' => 'Contact | Pruva Restaurant Kaş'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'contact_meta_description',
                'value' => [
                    'tr' => 'Bizimle iletişime geçin, rezervasyon yapın.',
                    'en' => 'Get in touch with us, make a reservation.'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'menu_meta_title',
                'value' => [
                    'tr' => 'Menü | Pruva Restaurant Kaş',
                    'en' => 'Menu | Pruva Restaurant Kaş'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'menu_meta_description',
                'value' => [
                    'tr' => 'Akdeniz mutfağının en seçkin lezzetleri, taze deniz ürünleri ve mezeler.',
                    'en' => 'The most exclusive flavors of Mediterranean cuisine, fresh seafood and appetizers.'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'blog_meta_title',
                'value' => [
                    'tr' => 'Günlük & Hikayeler | Pruva Restaurant Kaş',
                    'en' => 'Journal & Stories | Pruva Restaurant Kaş'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'blog_meta_description',
                'value' => [
                    'tr' => 'Akdeniz\'in kalbinden en son haberleri, yemek tariflerini ve hikayeleri keşfedin.',
                    'en' => 'Discover the latest news, recipes, and stories from the heart of the Mediterranean.'
                ],
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'favicon',
                'value' => ['tr' => 'favicon.png', 'en' => 'favicon.png'],
                'type' => 'image',
                'group' => 'branding',
            ],
            // Dynamic Page Images
            [
                'key' => 'hero_images',
                'value' => ['tr' => ['gallery/DJI_0834-Edit-scaled.jpg'], 'en' => ['gallery/DJI_0834-Edit-scaled.jpg']],
                'type' => 'images',
                'group' => 'branding',
            ],
            [
                'key' => 'story_image',
                'value' => ['tr' => 'gallery/029A5160.jpg', 'en' => 'gallery/029A5160.jpg'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'menu_restaurant_image',
                'value' => ['tr' => 'gallery/029A0989.jpg', 'en' => 'gallery/029A0989.jpg'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'menu_snacks_image',
                'value' => ['tr' => 'gallery/029A0982.jpg', 'en' => 'gallery/029A0982.jpg'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'menu_drinks_image',
                'value' => ['tr' => 'gallery/029A5151.jpg', 'en' => 'gallery/029A5151.jpg'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'parallax_image',
                'value' => ['tr' => 'gallery/029A5379.jpg', 'en' => 'gallery/029A5379.jpg'],
                'type' => 'image',
                'group' => 'branding',
            ],
            // Homepage Texts
            [
                'key' => 'hero_welcome_text',
                'value' => ['tr' => 'Pruva\'ya Hoş Geldiniz', 'en' => 'Welcome to Pruva'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_title',
                'value' => [
                    'tr' => 'Saf Akdeniz Ruhu,<br><span class="font-normal italic">Bir Sahil Hikayesi.</span>', 
                    'en' => 'Pure Mediterranean Soul,<br><span class="font-normal italic">A Coastal Tale.</span>'
                ],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_discover_menu_text',
                'value' => ['tr' => 'Menüyü Keşfet', 'en' => 'Discover Menu'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_book_table_text',
                'value' => ['tr' => 'Rezervasyon Yap', 'en' => 'Book a Table'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'about_welcome_text',
                'value' => ['tr' => 'Hikayemiz', 'en' => 'Our Story'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'about_title',
                'value' => [
                    'tr' => 'Şehrin kalabalığından uzakta<br><span class="italic text-brand-accent">bir lezzet deneyimi</span>', 
                    'en' => 'A flavor experience<br><span class="italic text-brand-accent">away from the city\'s crowd</span>'
                ],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'about_description_1',
                'value' => [
                    'tr' => 'Pruva Restaurant, Antalya Kaş\'taki Çukurbağ Yarımadası\'nda yer alan bir Akdeniz mutfağı destinasyonudur. Taze deniz ürünleri, geleneksel Türk mezeleri ve yerel Akdeniz lezzetleri konusunda uzmanlaşmıştır.',
                    'en' => 'Pruva Restaurant is a Mediterranean dining destination located on the Çukurbağ Peninsula in Kaş, Antalya. It specializes in fresh seafood, traditional Turkish mezze, and local Mediterranean flavors.'
                ],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'about_description_2',
                'value' => [
                    'tr' => 'Misafirlerine, gurme yemekleri eğlence ve nefes kesen gün batımı deniz manzarasıyla birleştiren canlı bir deneyim sunuyoruz.',
                    'en' => 'Offering guests a vibrant experience that combines gourmet dining with entertainment and breathtaking sunset sea views.'
                ],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'about_button_text',
                'value' => ['tr' => 'Hikayemizi Oku', 'en' => 'Read Our Story'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'experience_title',
                'value' => ['tr' => '"Sahilde Bağlantı"', 'en' => '"Connection Over the Coast"'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'experience_subtitle',
                'value' => ['tr' => 'Altın saatin huzuru', 'en' => 'The peace of the golden hour'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'culinary_welcome_text',
                'value' => ['tr' => 'Mutfak Mükemmelliği', 'en' => 'Culinary Excellence'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'culinary_title',
                'value' => ['tr' => 'Duyular İçin İşlendi', 'en' => 'Crafted for the Senses'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'culinary_button_text',
                'value' => ['tr' => 'Tüm Menüyü Görüntüle', 'en' => 'View Full Menu'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'testimonials_welcome_text',
                'value' => ['tr' => 'Referanslar', 'en' => 'Testimonials'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'testimonials_title',
                'value' => ['tr' => 'Misafirlerimiz Ne Diyor', 'en' => 'What Our Guests Say'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'testimonials_footer_text',
                'value' => ['tr' => 'Bizi ziyaret ettiniz mi?', 'en' => 'Have you visited us?'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'testimonials_google_button',
                'value' => ['tr' => 'Google\'da Değerlendir', 'en' => 'Review on Google'],
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'testimonials_tripadvisor_button',
                'value' => ['tr' => 'TripAdvisor\'da Değerlendir', 'en' => 'Review on TripAdvisor'],
                'type' => 'text',
                'group' => 'homepage',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
