<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    protected $fillable = [
        'name', 'type', 'headline', 'caption', 'main_content_url', 'image_url'
    ];
}
