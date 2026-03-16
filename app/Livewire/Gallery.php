<?php
namespace App\Livewire;

use App\Models\GalleryImage;
use Livewire\Component;

class Gallery extends Component
{
    public function render()
    {
        $images = GalleryImage::where('is_active', true)->orderBy('order_column')->get();
        
        return view('livewire.gallery', [
            'images' => $images
        ])->layout('components.layouts.app', [
            'title' => \App\Models\Setting::getValue('gallery_meta_title', __('Gallery') . ' - Pruva Restaurant Kaş'),
            'description' => \App\Models\Setting::getValue('gallery_meta_description', __('Snapshots, flavors, and views from Pruva Restaurant.'))
        ]);
    }
}
