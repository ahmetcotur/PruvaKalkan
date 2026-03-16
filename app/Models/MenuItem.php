<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

use App\Traits\HasResponsiveImages;

class MenuItem extends Model
{
    use HasTranslations, HasResponsiveImages;

    protected $guarded = [];
    
    public $translatable = ['name', 'slug', 'description', 'allergen_info'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_vegan' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
