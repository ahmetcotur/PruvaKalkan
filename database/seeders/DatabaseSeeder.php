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

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // Or keep current logic if needed, but adding a default admin is standard
        ]);
    }
}
