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
                'value' => ['tr' => 'info@pruvakas.com', 'en' => 'info@pruvakas.com'],
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
                'key' => 'favicon',
                'value' => ['tr' => 'favicon.png', 'en' => 'favicon.png'],
                'type' => 'image',
                'group' => 'branding',
            ],
            // Dynamic Page Images
            [
                'key' => 'hero_images',
                'value' => ['tr' => ['gallery/dji_0834-edit-scaled.webp'], 'en' => ['gallery/dji_0834-edit-scaled.webp']],
                'type' => 'images',
                'group' => 'branding',
            ],
            [
                'key' => 'story_image',
                'value' => ['tr' => 'gallery/029a5160.webp', 'en' => 'gallery/029a5160.webp'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'menu_restaurant_image',
                'value' => ['tr' => 'gallery/029a0989.webp', 'en' => 'gallery/029a0989.webp'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'menu_snacks_image',
                'value' => ['tr' => 'gallery/029a0982.webp', 'en' => 'gallery/029a0982.webp'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'menu_drinks_image',
                'value' => ['tr' => 'gallery/029a5151.webp', 'en' => 'gallery/029a5151.webp'],
                'type' => 'image',
                'group' => 'branding',
            ],
            [
                'key' => 'parallax_image',
                'value' => ['tr' => 'gallery/029A5379.webp', 'en' => 'gallery/029A5379.webp'],
                'type' => 'image',
                'group' => 'branding',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
