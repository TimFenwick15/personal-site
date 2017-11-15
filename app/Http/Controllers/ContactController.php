<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contact;

class ContactController extends Controller
{
    public function populate() {
        Contact::updateOrCreate([
            'name' => 'GitHub Profile',
            'type' => 'Contact',
            'headline' => 'GitHub logo',
            'caption' => 'My GitHub Profile',
            'main_content_url' => 'https://github.com/timfenwick15',
        ]);
        Contact::updateOrCreate([
            'name' => 'Twitter Profile',
            'type' => 'Contact',
            'headline' => 'Twitter logo',
            'caption' => 'My Twitter Profile',
            'main_content_url' => 'https://twitter.com/timfenwick15',
        ]);
    }
    public function render() {
        $data = collect(DB::select('SELECT * FROM contact'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data]);
    }
}
