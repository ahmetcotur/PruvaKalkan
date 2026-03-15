<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Menu;
use App\Livewire\Gallery;
use App\Livewire\Contact;
use App\Livewire\BlogIndex;
use App\Livewire\BlogPostShow;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/menu/{category?}/{subcategory?}', Menu::class)->name('menu');
    Route::get('/gallery', Gallery::class)->name('gallery');
    Route::get('/our-story', \App\Livewire\OurStory::class)->name('our-story');
    Route::get('/contact', Contact::class)->name('contact');
    Route::get('/blog', BlogIndex::class)->name('blog.index');
    Route::get('/privacy-policy', \App\Livewire\StaticPage::class)->defaults('slug', 'privacy-policy')->name('privacy-policy');
    Route::get('/terms-of-service', \App\Livewire\StaticPage::class)->defaults('slug', 'terms-of-service')->name('terms-of-service');
});
Route::get('/setup-server', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'SettingSeeder']);
        
        $uploadMax = ini_get('upload_max_filesize');
        $postMax = ini_get('post_max_size');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Önbellek temizlendi, Storage Link oluşturuldu ve Ayarlar başarıyla eklendi.',
            'php_upload_limit' => $uploadMax,
            'php_post_limit' => $postMax,
            'warning' => ($uploadMax === '2M' || $uploadMax === '10M') ? "DİKKAT: Sunucunuzun yükleme limiti şu an {$uploadMax}. Coolify'dan Nginx/PHP ayarlarından limitleri yükseltmelisiniz." : "Yükleme limitleriniz iyi görünüyor."
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});
// Blog posts outside prefix group to support legacy/clean URLs
Route::get('/{slug}', \App\Livewire\BlogPostShow::class)->name('blog.show');
