<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $slides = \App\Models\Slide::where('is_active', true)
            ->orderBy('order_column')
            ->get();

        return view('livewire.home', [
            'slides' => $slides
        ])->layout('components.layouts.app', [
            'title' => \App\Models\Setting::getValue('meta_title', __('Pruva Restaurant Kaş | The New Address of Flavor and Entertainment!')),
            'description' => \App\Models\Setting::getValue('meta_description', __('Pruva Restaurant in Kaş, Antalya. Fresh Mediterranean seafood, traditional Turkish mezze, and unforgettable sunset views.'))
        ]);
    }
}
