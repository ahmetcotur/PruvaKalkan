<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home')->layout('components.layouts.app', [
            'title' => __('Pruva Restaurant Kaş | The New Address of Flavor and Entertainment!'),
            'description' => __('Pruva Restaurant in Kaş, Antalya. Fresh Mediterranean seafood, traditional Turkish mezze, and unforgettable sunset views.')
        ]);
    }
}
