<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contact;

class TechController extends Controller
{
    public function render() {
        $tech = collect(DB::select('SELECT * FROM tech ORDER BY name'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $tech, 'visible' => false]);
    }
}
