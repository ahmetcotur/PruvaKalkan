<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

use App\Traits\HasResponsiveImages;

class BlogPost extends Model
{
    use HasTranslations, HasResponsiveImages;

    protected $guarded = [];

    public $translatable = ['title', 'slug', 'description', 'content', 'map_iframe'];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];
}
