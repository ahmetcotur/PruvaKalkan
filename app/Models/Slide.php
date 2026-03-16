<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\HasResponsiveImages;

class Slide extends Model
{
    use HasTranslations, HasResponsiveImages;

    protected $guarded = [];

    public $translatable = ['title', 'sub_title', 'description'];
}
