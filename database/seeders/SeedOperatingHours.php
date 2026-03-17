<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SeedOperatingHours extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'opening_days',
                'value' => [
                    'tr' => 'Her Gün',
                    'en' => 'Everyday',
                ],
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'opening_hours',
                'value' => [
                    'tr' => '19:00 — 00:00',
                    'en' => '19:00 — 00:00',
                ],
                'type' => 'text',
                'group' => 'contact',
            ],
        ];

        foreach ($settings as $settingData) {
            Setting::updateOrCreate(
                ['key' => $settingData['key']],
                $settingData
            );
        }
    }
}
