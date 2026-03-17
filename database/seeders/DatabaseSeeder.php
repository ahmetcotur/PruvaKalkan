<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            SocialSettingsSeeder::class,
            OurStorySettingsSeeder::class,
            GallerySeeder::class,
            MenuSeeder::class,
            BeverageMenuSeeder::class,
            LunchMenuSeeder::class,
            DinnerMenuSeeder::class,
            BlogPostsSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
