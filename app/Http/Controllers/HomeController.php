<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $cards = array(
            'key' => ['text' => 'Some Text'],
            'keytwo' => ['text' => 'Some Text'],
            'keythree' => ['text' => 'Some Text'],
            'keyfour' => ['text' => 'Some Text'],
        );
        return view('home', ['cards' => $cards]);
    }
}
