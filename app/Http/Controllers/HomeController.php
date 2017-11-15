<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }
    public function cards() {
        $cards = array(
            'key' => ['text' => 'Some Text'],
            'keytwo' => ['text' => 'Some Text'],
            'keythree' => ['text' => 'Some Text'],
            'keyfour' => ['text' => 'Some Text'],
        );
        return view('cards', ['cards' => $cards]);
    }
    public function contact() {
        $contacts = array(
            'key' => ['text' => 'Some Text'],
            'keytwo' => ['text' => 'Some Text'],
            'keythree' => ['text' => 'Some Text'],
            'keyfour' => ['text' => 'Some Text'],
        );
        return view('cards', ['cards' => $cards]);
    }
}
