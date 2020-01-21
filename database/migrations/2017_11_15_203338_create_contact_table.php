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
            'image_url' => secure_asset('image/GitHub-Mark.png')
        ]);
        Contact::create([
            'name' => 'Twitter Profile',
            'type' => 'Contact',
            'headline' => 'Twitter',
            'caption' => 'My Twitter Profile',
            'main_content_url' => 'https://twitter.com/timfenwick15',
            'image_url' => secure_asset('image/Twitter_Logo_Blue.svg')
        ]);
        Contact::create([
            'name' => 'LinkedIn Profile',
            'type' => 'Contact',
            'headline' => 'LinkedIn',
            'caption' => 'My LinkedIn Profile',
            'main_content_url' => 'https://www.linkedin.com/in/timothy-fenwick-0a23039b/',
            'image_url' => secure_asset('image/linkedin.png')
        ]);
        Contact::create([
            'name' => 'My CV',
            'type' => 'Contact',
            'headline' => 'CV',
            'caption' => 'My CV',
            'main_content_url' => 'https://www.dropbox.com/s/e69n9vgc45su02k/Timothy%20Fenwick%20CV.pdf?dl=0/',
            'image_url' => secure_asset('image/placeholder.png')
        ]);
        Contact::create([
            'name' => 'News Article',
            'type' => 'Contact',
            'headline' => 'News Article',
            'caption' => 'I have been involved with a project to repower refuse collection vehicles. The project was featured by various media outlets, including the BBC',
            'main_content_url' => 'https://www.bbc.co.uk/news/av/uk-england-south-yorkshire-49557954/sheffield-trials-waste-powered-bin-lorries-to-clean-up-streets',
            'image_url' => secure_asset('image/placeholder.png')
        ]);


        https://www.bbc.co.uk/news/av/uk-england-south-yorkshire-49557954/sheffield-trials-waste-powered-bin-lorries-to-clean-up-streets
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
