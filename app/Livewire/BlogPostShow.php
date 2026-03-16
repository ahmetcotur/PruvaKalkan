<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogPostShow extends Component
{
    public $post;

    public function mount($slug)
    {
        // Try to find by TR slug first
        $this->post = BlogPost::where('slug->tr', $slug)->first();
        if ($this->post) {
            app()->setLocale('tr');
            \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale('tr');
            return;
        }

        // Then try EN slug
        $this->post = BlogPost::where('slug->en', $slug)->first();
        if ($this->post) {
            app()->setLocale('en');
            \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale('en');
            return;
        }

        throw new NotFoundHttpException();
    }

    public function render()
    {
        return view('livewire.blog-post-show', [
            'title' => $this->post->title,
            'description' => $this->post->description,
        ])->layout('components.layouts.app', [
            'title' => $this->post->title . ' - ' . \App\Models\Setting::getValue('site_name', 'Pruva Restaurant Kaş'),
            'description' => substr(strip_tags($this->post->description), 0, 160)
        ]);
    }
}
