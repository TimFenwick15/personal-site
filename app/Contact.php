<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = [
        'name', 'type', 'headline', 'caption', 'main_content_url', 'image_url', 'source_update_time'
    ];
}
