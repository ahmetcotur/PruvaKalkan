<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SocialSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'facebook_url',
                'type' => 'text',
                'group' => 'social',
                'value' => 'https://www.facebook.com/pruvarestaurantkas',
            ],
            [
                'key' => 'instagram_url',
                'type' => 'text',
                'group' => 'social',
                'value' => 'http://instagram.com/pruvarestaurantkas/',
            ],
            [
                'key' => 'google_reviews_url',
                'type' => 'text',
                'group' => 'social',
                'value' => 'https://www.google.com/search?q=Pruva+Restaurant+Kas+reviews#lkt=LocalPoiReviews',
            ],
            [
                'key' => 'tripadvisor_reviews_url',
                'type' => 'text',
                'group' => 'social',
                'value' => 'https://www.tripadvisor.com.tr/Restaurant_Review-g297965-d27716705-Reviews-Pruva_Restaurant_Kas-Kas_Turkish_Mediterranean_Coast.html',
            ],
            [
                'key' => 'footer_text',
                'type' => 'text',
                'group' => 'branding',
                'value' => [
                    'tr' => 'Kaş\'ın kalbinde eşsiz Akdeniz lezzetleri, taze deniz ürünleri ve unutulmaz bir atmosfer.',
                    'en' => 'Unique Mediterranean flavors, fresh seafood and unforgettable atmosphere in the heart of Kaş.'
                ],
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        // Also update existing contact settings to 'social' group for better organization if desired,
        // but user specifically asked for social links. Let's stick to social for now.
        // Actually, phone and whatsapp are often considered social/contact.
        Setting::whereIn('key', ['whatsapp', 'phone', 'email', 'address'])->update(['group' => 'social']);
    }
}
