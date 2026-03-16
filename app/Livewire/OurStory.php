<?php

namespace App\Livewire;

use Livewire\Component;

class OurStory extends Component
{
    public function render()
    {
        return view('livewire.our-story')
            ->layout('components.layouts.app', [
                'title' => \App\Models\Setting::getValue('our_story_meta_title', __('Our Story Title') . ' | Pruva Restaurant Kaş'),
                'description' => \App\Models\Setting::getValue('our_story_meta_description', __('Our Story Subtitle'))
            ]);
    }
}
