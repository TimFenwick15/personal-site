<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Contact;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('headline')->unique();
            $table->string('caption');
            $table->string('type')->nullable(); // almost certainly will drop this
            $table->string('main_content_url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('source_update_time')->nullable();
        });
        Contact::create([
            'name' => 'GitHub Profile',
            'type' => 'Contact',
            'headline' => 'GitHub',
            'caption' => 'My GitHub Profile',
            'main_content_url' => 'https://github.com/timfenwick15',
            'image_url' => 'https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png'
        ]);
        Contact::create([
            'name' => 'Twitter Profile',
            'type' => 'Contact',
            'headline' => 'Twitter',
            'caption' => 'My Twitter Profile',
            'main_content_url' => 'https://twitter.com/timfenwick15',
            'image_url' => asset('image/Twitter_Logo_Blue.png')
        ]);
        Contact::create([
            'name' => 'LinkedIn Profile',
            'type' => 'Contact',
            'headline' => 'LinkedIn',
            'caption' => 'My LinkedIn Profile',
            'main_content_url' => 'https://www.linkedin.com/in/timothy-fenwick-0a23039b/',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
