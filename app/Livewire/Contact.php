<?php
namespace App\Livewire;

use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        return view('livewire.contact')->layout('components.layouts.app', [
            'title' => \App\Models\Setting::getValue('contact_meta_title', __('Contact') . ' - Pruva Restaurant Kaş'),
            'description' => \App\Models\Setting::getValue('contact_meta_description', __('Get in touch with us, make a reservation.'))
        ]);
    }
}
