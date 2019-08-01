<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Tech;

class CreateTechTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('headline')->unique();
            $table->string('caption');
            $table->string('type')->nullable();
            $table->string('main_content_url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('source_update_time')->nullable();
            $table->string('article_text');
        });
        Tech::create([
            'name' => 'JavaScript',
            'type' => 'Language',
            'headline' => 'JavaScript',
            'caption' => 'I\'ve used JavaScript in front-end development, back-end development with NodeJS, and automated web testing.',
            'main_content_url' => 'https://github.com/TimFenwick15/livingroom-data',
            'image_url' => secure_asset('image/javascript.png'),
            'article_text' => 'Example project...'
        ]);
        Tech::create([
            'name' => 'PHP',
            'type' => 'Language',
            'headline' => 'PHP',
            'caption' => 'I\'ve used PHP, within the Laravel framework, to create this website.',
            'main_content_url' => 'https://github.com/TimFenwick15/personal-site',
            'image_url' => secure_asset('image/php.png'),
            'article_text' => 'Example project...'
        ]);
        Tech::create([
            'name' => 'C',
            'type' => 'Language',
            'headline' => 'C',
            'caption' => 'At work, I write C on embedded devices for products such as electric buses, and electric refuse collection vehicles.',
            'main_content_url' => 'http://www.magtec.co.uk/index.php/en/',
            'image_url' => secure_asset('image/c.png'),
            'article_text' => 'Where I work...'
        ]);
        Tech::create([
            'name' => 'Hardware',
            'type' => 'Language',
            'headline' => 'Hardware',
            'caption' => 'I enjoy home automation projects using devices such as Arduinos, and ESP8266 WiFi controllers.',
            'main_content_url' => 'https://github.com/TimFenwick15/esp-home-dashboard',
            'image_url' => secure_asset('image/placeholder.png'),
            'article_text' => 'Example project...'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech');
    }
}
