<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

use App\Traits\HasResponsiveImages;

class GalleryImage extends Model
{
    use HasTranslations, HasResponsiveImages;

    protected $guarded = [];
    
    public $translatable = ['title', 'alt_text'];
}
