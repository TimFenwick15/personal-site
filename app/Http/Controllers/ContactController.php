<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contact;

class ContactController extends Controller
{
    public function render() {
        $data = collect(DB::select('SELECT * FROM contact ORDER BY name'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data, 'visible' => false]);
    }
}
