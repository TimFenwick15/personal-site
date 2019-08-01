<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tech extends Model
{
    protected $table = 'tech';
    protected $fillable = [
        'name', 'type', 'headline', 'caption', 'main_content_url', 'image_url', 'source_update_time', 'article_text'
    ];
}
